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

/**
 * Add foreign key constraint
 */
-- Between Books and Languages table
alter table Books
	add constraint fk_Books_Languages foreign key (LangID)
		references Languages (LangID)
;

-- Between Books and Categories table
alter table Books
	add constraint fk_Books_Categories foreign key (CategoryID)
		references Categories (CategoryID)
;

-- Between Reservations and Books table
alter table Reservations
	add constraint fk_Reservations_Books foreign key (ISBN)
		references Books (ISBN)
;

-- Between Reservations and Users table
alter table Reservations
	add constraint fk_Reservations_Users foreign key (UserID)
		references Users (UserID)
;

-- Between Loans and Books table
alter table Loans
	add constraint fk_Loans_Books foreign key (ISBN)
		references Books (ISBN)
;

-- Between Loans and Users table
alter table Loans
	add constraint fk_Loans_Users foreign key (UserID)
		references Users (UserID)
;
