/**
 * IPD-16 420-P75-AB PHP PROGRAMMING - FINAL PROJECT
 *
 * Create LibraryNORJ database
 *	Script Date: March 22, 2019
 *  Developed by: Nataliia Buchovska, Olga Gorborukova, Mohammadreza Saleh, Jeonghoon Lee
 */

-- Create database
create database LibraryNORJ
;
 
-- Switch to the LibraryNORJ database
use LibraryNORJ
;


-- 1. Users table
drop table if exists Users
;

create table Users (
    UserID int not null auto_increment,
    UserName varchar(20) not null unique,
    Password char(32) not null,
    FirstName varchar(20) not null,
    MiddleName varchar(20) null,
    LastName varchar(20) not null,
    UserType char(5) not null,
    Email varchar(40) null,
    BirthDate date null,
    RegisteredDate date not null,
    LastLoginTime datetime null,
    Photo varchar(100) null,
    
    constraint pk_Members primary key clustered (UserID asc)
)
;

-- 2. Books table
drop table if exists Books
;

create table Books
(
	ISBN int not null auto_increment,
	Title varchar(80) not null,
    Author varchar(30) not null,
    Publisher varchar(30) not null,
    Year char(4) not null,
    LangID int not null, 		-- foreign key (LanguageID in Languages Table)
	CategoryID int not null,	-- foreign Key (CategoryID in Categories Table)
	AgeRating tinyint not null,			-- (0: all, 1: adult-only)
    BookStatus varchar(10) not null,	-- (available, reserved, loaned)
    Description varchar(1024) null,
    BookImage varchar(100) null,

	constraint pk_Books primary key clustered (ISBN asc)
)
;

-- 3. Languages table
drop table if exists Languages
;

create table Languages
(
	LangID int not null auto_increment,
	LangDescrip varchar(30) not null,

	constraint pk_Languages primary key clustered (LangID asc)
)
;


-- 4. Categories table
drop table if exists Categories
;

create table Categories
(
	CategoryID int not null auto_increment,
	CategoryDescrip varchar(30) not null,

	constraint pk_Categories primary key clustered (CategoryID asc)
)
;


-- 5. Categories table
drop table if exists Reservations
;

create table Reservations
(
	ReservID int not null auto_increment, 
	ISBN int not null,				-- foreign Key (ISBN in Books table)
	UserID int not null,			-- foreign key (UserID in Users table)
	ReservDate datetime not null,
	ProcessedDate datetime null,
	ReservStatus varchar(10) not null,		-- (reserved, canceled, processed)

	constraint pk_Reservations primary key clustered (ReservID asc)   
)
;


-- 6. Loans table
drop table if exists Loans
;

create table Loans
(
	LoanID int not null auto_increment,
	ISBN int not null,			-- foreign Key (ISBN in Books)
	UserID int not null,		-- foreign key (UserID in Users)
	DateOut datetime not null,
	DateDue date not null,
	DateIn datetime null,
	FineAssessed decimal (5,2) null,
	FinePaid decimal (5,2) null,
	FineWaived decimal (5,2) null,

	constraint pk_Loans primary key clustered (LoanID asc)   
)
;


-- 7. ContactMessages table
drop table if exists ContactMessages
;

create table ContactMessages
(
	MsgID int not null auto_increment,
	Email varchar(50) not null,		
	Subject varchar(50) not null,		
	Message varchar(512) not null,		
	Name varchar(30) not null,
	Status int not null default 0

	constraint pk_ContactMessages primary key clustered (MsgID asc)   
)
;


