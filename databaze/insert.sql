call insert_forma('Bakalářské');
call insert_typ('Prezenční');
call insert_obor(
    'Kybernetika', -- Obor_nazev
    'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', -- Url
    'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické 
    znalosti v informatice.', -- Popis
    2, -- ID_typ
    2  -- ID_forma
);
call insert_oblast('Matematika'); 
call insert_priorita(1, 'Klíčová oblast');
call insert_obor_slovo (4,2, 1); -- ID_obor, ID_klicove_slovo, ID_priorita

call insert_klicove_slovo('Programování', 'základy programování v Jave');

