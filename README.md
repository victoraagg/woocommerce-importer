### First you need:

-Add all the global attributes in WooCommerce - Not the terms
-Add al the certificates
-Get the certificates ID to include into the insert process
-Upload all the images to current upload directory

### After:

-Save the wp-admin log file generated wc_insert_product_logs.txt, because contains all the relations between ID post and SKUS

### Remove all WooCommerce products 

### Remove all attributes from WooCommerce
DELETE FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy WHERE taxonomy LIKE 'pa_%');
DELETE FROM wp_term_taxonomy WHERE taxonomy LIKE 'pa_%';
DELETE FROM wp_term_relationships WHERE term_taxonomy_id not IN (SELECT term_taxonomy_id FROM wp_term_taxonomy);

### Delete all WooCommerce products
DELETE FROM wp_term_relationships WHERE object_id IN (SELECT ID FROM wp_posts WHERE post_type IN ('product','product_variation'));
DELETE FROM wp_postmeta WHERE post_id IN (SELECT ID FROM wp_posts WHERE post_type IN ('product','product_variation'));
DELETE FROM wp_posts WHERE post_type IN ('product','product_variation');

### Delete orphaned postmeta
DELETE pm
FROM wp_postmeta pm
LEFT JOIN wp_posts wp ON wp.ID = pm.post_id
WHERE wp.ID IS NULL;

### DELETE Orphan rows

### wp_posts -> wp_posts (parent/child)

DELETE wp_posts FROM wp_posts
LEFT JOIN wp_posts child ON (wp_posts.post_parent = child.ID)
WHERE (wp_posts.post_parent <> 0) AND (child.ID IS NULL);

### wp_postmeta -> wp_posts

DELETE wp_postmeta FROM wp_postmeta
LEFT JOIN wp_posts ON (wp_postmeta.post_id = wp_posts.ID)
WHERE (wp_posts.ID IS NULL);

### wp_term_taxonomy -> wp_terms

DELETE wp_term_taxonomy FROM wp_term_taxonomy
LEFT JOIN wp_terms ON (wp_term_taxonomy.term_id = wp_terms.term_id)
WHERE (wp_terms.term_id IS NULL);

### wp_term_relationships -> wp_term_taxonomy

DELETE wp_term_relationships FROM wp_term_relationships
LEFT JOIN wp_term_taxonomy
ON (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
WHERE (wp_term_taxonomy.term_taxonomy_id IS NULL);

### wp_usermeta -> wp_users

DELETE wp_usermeta FROM wp_usermeta
LEFT JOIN wp_users ON (wp_usermeta.user_id = wp_users.ID)
WHERE (wp_users.ID IS NULL);

### wp_posts -> wp_users

DELETE wp_posts FROM wp_posts
LEFT JOIN wp_users ON (wp_posts.post_author = wp_users.ID)
WHERE (wp_users.ID IS NULL);

### Other

### wp_postmeta dupes Where an identical meta_key exists for the same post more than once.

DELETE FROM wp_postmeta
WHERE (meta_id IN (
	SELECT * FROM (
		SELECT meta_id
		FROM wp_postmeta tmp
		GROUP BY post_id,meta_key
		HAVING (COUNT(*) > 1)
	) AS tmp
));

### wp_postmeta '_edit_lock' and  '_edit_last' rows
### Rows created against a post when edited by a WordPress admin user.

DELETE FROM wp_postmeta WHERE meta_key IN ('_edit_lock','_edit_last');

### wp_options '_transient_' rows
### A transient value is one stored by WordPress and/or a plugin generated from a complex query - basically a cache.

DELETE FROM wp_options WHERE option_name LIKE '%\_transient\_%';

### wp_posts revisions

DELETE FROM wp_posts WHERE (post_type = 'revision') AND (post_modified_gmt < DATE_SUB(NOW(),INTERVAL 15 DAY));

### You may need to run the [wp_postmeta -> wp_posts](#wp_postmeta---wp_posts) orphans query after cleaning up revisions.
