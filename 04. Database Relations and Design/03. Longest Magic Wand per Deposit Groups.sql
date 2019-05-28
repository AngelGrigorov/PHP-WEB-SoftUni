SELECT 
	deposit_group,
	MAX(magic_wand_size) AS longest_wand_size
	FROM wizzard_deposits
	GROUP BY deposit_group
	ORDER BY 2;
	