<!-- $query = "
    SELECT 
        a.nome AS aluno,
        a.idade AS idade,
        m.nome AS modalidade,
        a.ativo
    FROM 
        alunos a
    JOIN 
        modalidades_aluno ma ON a.id = ma.id_aluno
    JOIN 
        modalidades m ON ma.id_modalidade = m.id
    WHERE 
        a.ativo IS TRUE
        AND m.id = ?
    ORDER BY 
        a.nome;
"; -->
