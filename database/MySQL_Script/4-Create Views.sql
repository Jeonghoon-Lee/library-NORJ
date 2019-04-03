/**
 * IPD-16 420-P75-AB PHP PROGRAMMING - FINAL PROJECT
 *
 * Create View in LibraryNORJ database
 *	Script Date: March 29, 2019
 *  Developed by: Nataliia Buchovska, Olga Gorborukova, Mohammadreza Saleh, Jeonghoon Lee
 */
 
-- Switch to the LibraryNORJ database
use LibraryNORJ
;

-- booklist view
drop view if exists booklist_view
;

create view booklist_view
as 
select B.ISBN, B.Title, B.Author, B.Publisher, B.Year, 
	C.CategoryDescrip as Category, 
    L.LangDescrip as Language,
    B.AgeRating, B.BookStatus, B.Description, B.BookImage
from books as B 
	inner join categories as C
		on B.CategoryID = C.CategoryID
	inner join languages as L
		on B.LangID = L.LangID
order by B.ISBN
;

select * 
from booklist_view
;


-- reservation user list view
drop view if exists reserve_user_view
;

create view reserve_user_view
as 
select R.ReservID, R.ISBN, R.UserID, U.UserName, BV.Title, 
	BV.Author, R.ReservDate, R.ProcessedDate, R.ReservStatus
from reservations as R
	inner join users as U
		on R.UserID = U.UserID
	inner join booklist_view as BV
		on R.ISBN = BV.ISBN
order by R.ReservID desc
;

select *
from reserve_user_view
;


-- loan user list view
drop view if exists loan_user_view
;

create view loan_user_view
as 
select L.LoanID, L.ISBN, L.UserID, U.UserName, BV.Title, 
	BV.Author, L.DateOut, L.DateDue, L.Datein, 
    L.FineAssessed, L.FinePaid, L.FineWaived
from loans as L
	inner join users as U
		on L.UserID = U.UserID
	inner join booklist_view as BV
		on L.ISBN = BV.ISBN
order by L.LoanID desc
;

select *
from loan_user_view
;
