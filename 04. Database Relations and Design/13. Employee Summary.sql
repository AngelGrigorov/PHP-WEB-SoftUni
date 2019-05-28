SELECT e.employee_id,
 CONCAT(e.first_name, ' ' , e.last_name) AS employee_name,
CONCAT(e1.first_name, ' ', e1.last_name) as manager_name,
 d.name AS department_name 
FROM employees AS e
JOIN employees AS e1 
ON e.manager_id = e1.employee_id 

JOIN departments AS d 
ON d.department_id = e.department_id
WHERE e.manager_id IS NOT NULL
ORDER BY e.employee_id 
LIMIT 5;