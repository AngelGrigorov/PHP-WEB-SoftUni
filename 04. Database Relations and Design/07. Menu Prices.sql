SELECT p.category_id,
 ROUND(AVG(p.price), 2) AS `Average Price`,
 MIN(p.price) AS `Cheapest Product`,
 MAX(p.price) AS `Most Expensive Product`
FROM products AS p
GROUP BY p.category_id;
