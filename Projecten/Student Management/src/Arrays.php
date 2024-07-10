<?PHP

$mentors = [
    new Mentor('Annelies de Boer', '1-3-1980', 'annelies.deboer@example.com', '06 - 12345678'),
    new Mentor('Peter van Dijk', '10-06-1975', 'peter.vandijk@example.com', '06-23456789'),
    new Mentor('Fatima El Amrani', '5-09-1982', 'elamrani@example.com', '06-34567890')
];

$schoolClasses = [
    new SchoolClass('1A', 1, $mentors[0]),
    new SchoolClass('2B', 2, $mentors[1]),
    new SchoolClass('3C', 3, $mentors[2])
];

$schoolClasses[0]->addStudent(
    new Student('Jan de Vries', '10-01-2005', 'jan.devres@example.com', '06-12345678'),
    new Student('Lisa Jansen', '5-03-2005', 'lisa.jansen@example.com', '06-23456789'),
    new Student('Mohammed Ali', '15-05-2004', 'mohammed.ali@example.com', '06-34567890'),
    new Student('Emma van Dijk', '20-08-2005', 'emma.vandijk@example.com', '06-45678901'),
    new Student('Luca Bakker', '3-12-2004', 'luca.bakker@example.com', '06-56789012')
);

$schoolClasses[1]->addStudent(
    new Student('Sophie de Jong', '18-07-2005', 'sophie.dejong@example.com', '06-67890123'),
    new Student('Daan Visser', '22-09-2004', 'daan.visser@example.com', '06-78901234'),
    new Student('Anna Hendriks', '9-06-2005', 'anna.hendriks@example.com', '06-89012345'),
    new Student('Thomas Kuijpers', '14-02-2004', 'thomas.kuijpers@example.com', '06-90123456'),
    new Student('Evi Meijer', '30-10-2004', 'evi.meijer@example.com', '06-01234567')
);

$schoolClasses[2]->addStudent(
    new Student('Sem van der Meer', '7 11-2005', 'sem.vandermeer@example.com', '06-11223344'),
    new Student('Zoë Peters', '25 april 2004', 'zoe.peters@example.com', '06-22334455'),
    new Student('Timo Smit', '12-12-2005', 'timo.smit@example.com', '06-33445566'),
    new Student('Femke de Boer', '28-09-2004', 'femke.deboer@example.com', '06-44556677'),
    new Student('Ruben van Leeuwen', '8-01-2005', 'ruben.vanleeuwen@example.com', '06-55667788')
);



