/**
 * IPD-16 420-P75-AB PHP PROGRAMMING - FINAL PROJECT
 *
 * Apply data integrity into LibraryNORJ database
 *	Script Date: March 22, 2019
 *  Developed by: Nataliia Buchovska, Olga Gorborukova, Mohammadreza Saleh, Jeonghoon Lee
 */

-- Switch to the LibraryNORJ database
use LibraryNORJ
;

-- 1. Insert data into Languages table
insert into Languages (LangDescrip)
	values ('English'),
		('French'),
		('Arabic'),
		('Chinese'),
		('Korean'),
		('Russian'),
		('Spanish')
;

-- 2. Insert data into Categories table
insert into Categories (CategoryDescrip)
	values ('Art & Music'),
		('Business & Finance'),
        ('Kids'),
        ('Comics'),
        ('Computer & Tech'),
        ('Cooking'),
        ('Health & Fitness'),
        ('Literature & Fiction'),
        ('Entertainment'),
        ('Science'),
        ('Education & Reference'),
        ('History')
;

-- 3. Insert data into Users table
load data infile 'C:/MAMP/htdocs/library-NORJ/MySQL Script/data/users.csv'
	into table Users
	fields terminated by ','
	lines terminated by '\r\n'
	ignore 1 rows
    (
		UserName, @Password, FirstName, @MiddleName, LastName,
        UserType, Email, BirthDate, RegisteredDate, @LastLoginTime
	)
    set
		Password = md5(@Password),
        MiddleName = nullif(@MiddleName, ''),
        LastLoginTime = nullif(@LastLoginTime, '')
;
select * from Users
;

-- 4. Insert data into Books table
load data infile 'C:/MAMP/htdocs/library-NORJ/MySQL Script/data/books.txt'
	into table Books
	fields terminated by '\t'
	lines terminated by '\r\n'
	ignore 1 rows
    (
		Title, Author, Publisher, Year, LangID,
        CategoryID, AgeRating, BookStatus, Description
	)
;
select * from Books
;
