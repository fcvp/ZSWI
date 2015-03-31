call update_forma(3, 'Doktorské');
call update_typ(1, 'Prezenční');

call update_obor(
	1,
    'Informatika', -- Obor_nazev
    'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', -- Url
    'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické 
    znalosti v informatice.', -- Popis
    1, -- ID_typ
    3  -- ID_forma
);

call update_priorita(1,0,'malá priorita');
call update_oblast(2, 'Matematika'); 