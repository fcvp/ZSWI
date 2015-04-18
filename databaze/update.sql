call update_forma(1, 'Prezeční');
call update_typ(1, 'Bakalářské');

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

 -- ID_obor, ID_klicove_slovo, ID_obor_novy, ID_klicove_slovo_nove  ID_priorita
call update_obor_slovo (1,10,1,1, 5);

call update_klicove_slovo(6, 'Matematická analýza', 5, 'Definice, věty, důkazy, integrály, derivace.');