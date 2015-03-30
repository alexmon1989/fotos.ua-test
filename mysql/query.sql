SELECT 	c.name,
        COUNT(p.id) AS items_count, 
        MIN(p.price) AS min_price,  
        MAX(p.price) AS max_price, 
        MAX(p.name) AS max_name_len, 
        MAX(LENGTH(p.description)) AS max_desc_len, 
        MAX(p.description) AS max_desc

FROM categories AS c

INNER JOIN products AS p
		ON p.category_id = c.id

GROUP BY c.id

ORDER BY c.name ASC