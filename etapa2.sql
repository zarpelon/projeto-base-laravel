/*
    Em conversa com Rafael, consideramos que os valores de to_date = '9999-01-01'
    deveriam ser considerados como NULL, meu usuário do teste (ditechguy) não 
    possui permissão para UPDATE, logo adicionei na cláusula WHERE para 
    desconsiderar esses valores.
*/

    SELECT d.dept_name AS dept_name
         , CONCAT(e.first_name, ' ', e.last_name) AS full_name_emp
         , DATEDIFF(de.to_date, de.from_date) AS worked_dpt_emp
         
      FROM employees e 
     
INNER JOIN dept_emp de 
        ON e.emp_no = de.emp_no

INNER JOIN departments d 
        ON de.dept_no = d.dept_no

     WHERE (de.to_date IS NOT NULL AND de.to_date != '9999-01-01')  
        
  ORDER BY worked_dpt_emp DESC
 
     LIMIT 10