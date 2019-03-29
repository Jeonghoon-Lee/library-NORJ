/**
 * IPD-16 420-P75-AB PHP PROGRAMMING - FINAL PROJECT
 *
 * Create Triggers in LibraryNORJ database
 *	Script Date: March 29, 2019
 *  Developed by: Nataliia Buchovska, Olga Gorborukova, Mohammadreza Saleh, Jeonghoon Lee
 */
 
-- Switch to the LibraryNORJ database
use LibraryNORJ
;

/**
 * Triggers for reservation table
 * If reservation status is changed, it will update book table
 */
-- insert
delimiter $$
drop trigger if exists insert_reserve_status_tr $$

create trigger insert_reserve_status_tr
	after insert
    on reservations
	for each row
begin
	if NEW.ReservStatus = 'reserved' then
		call update_book_status_pr(NEW.ISBN, 'reserved');
	else
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;

-- update
delimiter $$
drop trigger if exists update_reserve_status_tr $$

create trigger update_reserve_status_tr
	after update
    on reservations
	for each row
begin
	if NEW.ReservStatus = 'reserved' then
		call update_book_status_pr(NEW.ISBN, 'reserved');
	else
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;

-- delete
delimiter $$
drop trigger if exists delete_reserve_status_tr $$

create trigger delete_reserve_status_tr
	after delete
    on reservations
	for each row
begin
	-- change book stuatus as 'available'
	if OLD.ReservStatus = 'reserved' then
		call update_book_status_pr(OLD.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;

/**
 * Triggers for loans table
 * If loans status is changed, it will update book table
 */
-- insert
delimiter $$
drop trigger if exists insert_loan_status_tr $$

create trigger insert_loan_status_tr
	after insert
    on loans
	for each row
begin
	if NEW.DateIn is null and NEW.DateOut is not null then
		call update_book_status_pr(NEW.ISBN, 'loaned');
	elseif NEW.DateIn is not null then
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;

-- update
delimiter $$
drop trigger if exists update_loan_status_tr $$

create trigger update_loan_status_tr
	after update
    on loans
	for each row
begin
	if NEW.DateIn is null and NEW.DateOut is not null then
		call update_book_status_pr(NEW.ISBN, 'loaned');
	elseif NEW.DateIn is not null then
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;

-- delete
delimiter $$
drop trigger if exists delete_loan_status_tr $$

create trigger delete_loan_status_tr
	after delete
    on loans
	for each row
begin
	-- recover book status as available
	if OLD.DateIn is null and OLD.DateOut is not null then
		call update_book_status_pr(OLD.ISBN, 'available');
	end if
    ;
end$$ 
delimiter ;


-- procedure to update book status
delimiter $$
drop procedure if exists update_book_status_pr $$

create procedure update_book_status_pr (in isbn int, in bookstatus varchar(10))
begin
	update books as B
		set B.BookStatus = bookstatus
        where B.ISBN = isbn
        ;
end$$
delimiter ;
