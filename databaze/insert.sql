call insert_forma('Doktorské');
call insert_typ('Kombinované');
call insert_obor(
    'Informatika', -- Obor_nazev
    'http://fav.zcu.cz/pro-uchazece/bakalarske-studium/informatika/', -- Url
    'Obor je určen pro studenty, kteří chtějí získat teoretický základ i praktické 
    znalosti v informatice.', -- Popis
    1, -- ID_typ
    1  -- ID_forma
);
call insert_oblast('Matematika'); 
call insert_priorita(1, 'Klíčová oblast');
call insert_obor_slovo (1, 1, 1); -- ID_obor, ID_klicove_slovo, ID_priorita

call insert_klicove_slovo('Matematická analýza', 'Definice, věty, důkazy, integrály, derivace.');

