-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 02, 2019 at 06:49 AM
-- Server version: 5.7.24-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarynorj`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_book_status_pr` (IN `isbn` INT, IN `bookstatus` VARCHAR(10))  begin
	update books as B
		set B.BookStatus = bookstatus
        where B.ISBN = isbn
        ;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `booklist_view`
-- (See below for the actual view)
--
CREATE TABLE `booklist_view` (
`ISBN` int(11)
,`Title` varchar(80)
,`Author` varchar(30)
,`Publisher` varchar(30)
,`Year` char(4)
,`Category` varchar(30)
,`Language` varchar(30)
,`AgeRating` tinyint(4)
,`BookStatus` varchar(10)
,`Description` varchar(1024)
,`BookImage` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` int(11) NOT NULL,
  `Title` varchar(80) NOT NULL,
  `Author` varchar(30) NOT NULL,
  `Publisher` varchar(30) NOT NULL,
  `Year` char(4) NOT NULL,
  `LangID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `AgeRating` tinyint(4) NOT NULL,
  `BookStatus` varchar(10) NOT NULL,
  `Description` varchar(1024) DEFAULT NULL,
  `BookImage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `Title`, `Author`, `Publisher`, `Year`, `LangID`, `CategoryID`, `AgeRating`, `BookStatus`, `Description`, `BookImage`) VALUES
(1, 'Last of the Mohicans', 'James Fenimore Cooper', 'Ace Books', '2019', 1, 8, 1, 'reserved', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00001.jpg'),
(2, 'The Village Watch-Tower', 'Kate Douglas Wiggin', 'Basic Books', '2019', 1, 8, 0, 'loaned', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00002.jpg'),
(3, 'Self Help; Conduct & Perseverance', 'Samuel  Smiles', 'Frederic C. Beil', '2018', 1, 7, 1, 'reserved', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00003.jpg'),
(4, 'Songs of a Savoyard', 'W. S. Gilbert', 'Berkley', '1999', 1, 1, 0, 'reserved', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00004.jpg'),
(5, 'Fall of the House of Usher', 'Edgar Allen Poe', 'Bullitt Publishing', '2010', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00005.jpg'),
(6, 'The Cook\'s Decameron', 'W. G. Water', 'Doubleday', '2019', 1, 6, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00006.jpg'),
(7, 'Poems', 'Wilfred  Owen', 'FaithWords', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(8, 'The Cherry Orchard', 'Anton  Checkov', 'Five Star', '2013', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00008.jpg'),
(9, 'Wayfarers', 'Knut  Hamsun', 'Harlem Moon', '2003', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(10, 'The Night-Born', 'Jack  London', 'Harper UK', '2004', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', '00010.jpg'),
(11, 'Lemon', 'Motojirou  ', 'Kensington Publishing', '2008', 1, 4, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(12, 'Walking', 'Henry David Thoreau', 'Llewellyn', '2013', 1, 2, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(13, 'The Water-Babies', 'Charles  Kingsley', 'Milkweed Editions', '2015', 1, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(14, 'Improvement of Understanding', 'Spinoza  ', 'Pantheon', '2019', 1, 11, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(15, 'The Dictionary of the Khazars', 'Milorad  Pavic', 'Simon & Schuster', '2019', 1, 11, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(16, 'The First Men In The Moon', 'H.G.  Wells', 'Ace Books', '2018', 1, 10, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(17, 'Ballads of a Bohemian', 'Robert W. Service', 'Basic Books', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(18, 'War and Peace', 'Lev  Tolstoy', 'Frederic C. Beil', '2013', 1, 12, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(19, 'The Phantom of the Opera', 'Gaston  Leroux', 'Berkley', '2015', 1, 1, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(20, 'The Unbearable Lightness of Being', 'Milan  Kundera', 'Bullitt Publishing', '2019', 1, 2, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(21, 'Le Petit Prince', 'Antoine de Saint-Exupery', 'Doubleday', '2019', 2, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(22, 'The Master and Margarita', 'Mikhael  Bulgakov', 'Ace Books', '2018', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(23, 'De La Terre a La Lune', 'Jules  Verne', 'Basic Books', '2018', 2, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(24, 'Tao Teh King', 'Lau-Tzu  ', 'Frederic C. Beil', '2015', 4, 9, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(25, 'The Black Tulip', 'Alexandre  Dumas', 'Berkley', '2019', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(26, 'The Adventures of Robin Hood', 'Howard  Pyle', 'Bullitt Publishing', '2019', 1, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(27, 'Lady Susan', 'Jane  Austen', 'Doubleday', '2018', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(28, 'The Voyage of the Beagle', 'Charles  Darwin', 'FaithWords', '2018', 1, 10, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(29, 'Misalliance', 'George Bernard Shaw', 'Five Star', '2013', 1, 2, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(30, 'A Tale of Two Cities', 'Charles  Dickens', 'Harlem Moon', '2015', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(31, 'Oliver Twist', 'Charles  Dickens', 'Harper UK', '2019', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(32, 'The Call of the Wild', 'Jack  London', 'Kensington Publishing', '2019', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(33, 'The Legend of Sleepy Hollow', 'Washington  Irving', 'Llewellyn', '2018', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(34, 'The Return of Sherlock Holmes', 'Arthur Conan Doyle', 'Milkweed Editions', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(35, 'The Scarlet Letter', 'Nathaniel Hawthorne ', 'FaithWords', '2015', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(36, 'Treasure Island', 'Robert Louis Stevenson', 'Five Star', '2019', 1, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(37, 'Les Miserables', 'Victor Marie Hugo', 'Harlem Moon', '2019', 2, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(38, 'Moby Dick', 'Herman  Melville', 'Harper UK', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(39, 'Moll Flanders', 'Daniel  Defoe', 'Kensington Publishing', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(40, 'Sense and Sensibility', 'Jane  Austen', 'Llewellyn', '2013', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(41, 'Vanity Fair', 'Daniel  Defoe', 'Milkweed Editions', '2015', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(42, 'Emma', 'Jane  Austen', 'Simon & Schuster', '2019', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(43, 'Adventures of Huckleberry Finn', 'Mark  Twain', 'Ace Books', '2019', 1, 3, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(44, 'Candide', 'Voltaire  ', 'Basic Books', '2018', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(45, 'The Complete Works of William Shakespeare', 'William  Shakespeare', 'Frederic C. Beil', '2018', 1, 11, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(46, 'The Crossing', 'Winston  Churchill', 'Berkley', '2015', 1, 8, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(47, 'History of the Decline and Fall of the Roman Empire', 'Edward  Gibbon', 'Bullitt Publishing', '2019', 1, 12, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(48, 'Julius Caesar\'s Commentaries on the Gallic War', 'Julius  Caesar', 'Doubleday', '2019', 1, 12, 0, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg'),
(49, 'Frankenstein', 'Mary Wollstonecraft Shelley', 'Kensington Publishing', '2018', 1, 8, 1, 'available', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae eros eget neque sollicitudin suscipit. Donec mauris odio, aliquet id sollicitudin non, sodales in ante. Curabitur sapien odio, convallis sed neque hendrerit, accumsan pretium velit. Donec feugiat hendrerit turpis eget rutrum. Pellentesque et metus ante. Cras eget augue orci. Proin dapibus odio in nunc sollicitudin, ac aliquet felis viverra.\"', 'no_image_book.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryDescrip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryDescrip`) VALUES
(1, 'Art & Music'),
(2, 'Business & Finance'),
(3, 'Kids'),
(4, 'Comics'),
(5, 'Computer & Tech'),
(6, 'Cooking'),
(7, 'Health & Fitness'),
(8, 'Literature & Fiction'),
(9, 'Entertainment'),
(10, 'Science'),
(11, 'Education & Reference'),
(12, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `MsgID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Message` varchar(512) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`MsgID`, `Email`, `Subject`, `Message`, `Name`, `Status`) VALUES
(1, 'hoon22.lee@gmail.com', '2313', '21312', 'Jeonghoon Lee', 0),
(2, 'hoon22.lee@gmail.com', 'rewr', 'fadf', 'Jeonghoon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `LangID` int(11) NOT NULL,
  `LangDescrip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`LangID`, `LangDescrip`) VALUES
(1, 'English'),
(2, 'French'),
(3, 'Arabic'),
(4, 'Chinese'),
(5, 'Korean'),
(6, 'Russian'),
(7, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `LoanID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DateOut` datetime NOT NULL,
  `DateDue` date NOT NULL,
  `DateIn` datetime DEFAULT NULL,
  `FineAssessed` decimal(5,2) DEFAULT NULL,
  `FinePaid` decimal(5,2) DEFAULT NULL,
  `FineWaived` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`LoanID`, `ISBN`, `UserID`, `DateOut`, `DateDue`, `DateIn`, `FineAssessed`, `FinePaid`, `FineWaived`) VALUES
(1, 2, 7, '2019-03-29 00:00:00', '2019-04-07', NULL, NULL, NULL, NULL),
(2, 42, 7, '2019-04-01 00:00:00', '2019-04-07', '2019-04-02 00:00:00', NULL, NULL, NULL),
(3, 49, 7, '2019-03-29 00:00:00', '2019-04-07', NULL, NULL, NULL, NULL);

--
-- Triggers `loans`
--
DELIMITER $$
CREATE TRIGGER `delete_loan_status_tr` AFTER DELETE ON `loans` FOR EACH ROW begin
	-- recover book status as available
	if OLD.DateIn is null and OLD.DateOut is not null then
		call update_book_status_pr(OLD.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_loan_status_tr` AFTER INSERT ON `loans` FOR EACH ROW begin
	if NEW.DateIn is null and NEW.DateOut is not null then
		call update_book_status_pr(NEW.ISBN, 'loaned');
	elseif NEW.DateIn is not null then
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_loan_status_tr` AFTER UPDATE ON `loans` FOR EACH ROW begin
	if NEW.DateIn is null and NEW.DateOut is not null then
		call update_book_status_pr(NEW.ISBN, 'loaned');
	elseif NEW.DateIn is not null then
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `loan_user_view`
-- (See below for the actual view)
--
CREATE TABLE `loan_user_view` (
`LoanID` int(11)
,`ISBN` int(11)
,`UserID` int(11)
,`UserName` varchar(20)
,`Title` varchar(80)
,`Author` varchar(30)
,`DateOut` datetime
,`DateDue` date
,`Datein` datetime
,`FineAssessed` decimal(5,2)
,`FinePaid` decimal(5,2)
,`FineWaived` decimal(5,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ReservID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ReservDate` datetime NOT NULL,
  `ProcessedDate` datetime DEFAULT NULL,
  `ReservStatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ReservID`, `ISBN`, `UserID`, `ReservDate`, `ProcessedDate`, `ReservStatus`) VALUES
(1, 1, 7, '2019-03-29 00:00:00', NULL, 'reserved'),
(2, 3, 6, '2019-04-01 20:49:46', NULL, 'reserved'),
(4, 4, 7, '2019-04-01 20:59:34', NULL, 'reserved');

--
-- Triggers `reservations`
--
DELIMITER $$
CREATE TRIGGER `delete_reserve_status_tr` AFTER DELETE ON `reservations` FOR EACH ROW begin
	-- change book stuatus as 'available'
	if OLD.ReservStatus = 'reserved' then
		call update_book_status_pr(OLD.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_reserve_status_tr` AFTER INSERT ON `reservations` FOR EACH ROW begin
	if NEW.ReservStatus = 'reserved' then
		call update_book_status_pr(NEW.ISBN, 'reserved');
	else
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_reserve_status_tr` AFTER UPDATE ON `reservations` FOR EACH ROW begin
	if NEW.ReservStatus = 'reserved' then
		call update_book_status_pr(NEW.ISBN, 'reserved');
	else
		call update_book_status_pr(NEW.ISBN, 'available');
	end if
    ;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `reserve_user_view`
-- (See below for the actual view)
--
CREATE TABLE `reserve_user_view` (
`ReservID` int(11)
,`ISBN` int(11)
,`UserID` int(11)
,`UserName` varchar(20)
,`Title` varchar(80)
,`Author` varchar(30)
,`ReservDate` datetime
,`ProcessedDate` datetime
,`ReservStatus` varchar(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Password` char(32) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `MiddleName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) NOT NULL,
  `UserType` char(5) NOT NULL,
  `Email` varchar(40) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `RegisteredDate` date NOT NULL,
  `LastLoginTime` datetime DEFAULT NULL,
  `Photo` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `FirstName`, `MiddleName`, `LastName`, `UserType`, `Email`, `BirthDate`, `RegisteredDate`, `LastLoginTime`, `Photo`) VALUES
(1, 'hoon', 'c4ca4238a0b923820dcc509a6f75849b', 'Jeonghoon', NULL, 'Lee', 'admin', 'hoon22.lee@gmail.com', '1972-12-31', '2019-03-01', '2019-04-02 02:06:18', NULL),
(2, 'nataliia', 'c4ca4238a0b923820dcc509a6f75849b', 'Nataliia', NULL, 'Buchovska', 'admin', '', '1985-01-01', '2019-03-01', NULL, NULL),
(3, 'olga', 'c4ca4238a0b923820dcc509a6f75849b', 'Olga', NULL, 'Gorborukova', 'admin', '', '1985-01-02', '2019-03-01', NULL, NULL),
(4, 'reza', 'c4ca4238a0b923820dcc509a6f75849b', 'Mohammadreza', NULL, 'Saleh', 'admin', '', '1985-01-03', '2019-03-01', NULL, NULL),
(5, 'james', 'c4ca4238a0b923820dcc509a6f75849b', 'James', 'Douglas', 'Cooper', 'user', 'james@gmail.com', '1990-01-01', '2019-03-02', '2019-03-22 12:11:00', NULL),
(6, 'kaila', 'c4ca4238a0b923820dcc509a6f75849b', 'Kaila', NULL, 'Cooper', 'user', '', '2009-12-03', '2019-03-02', NULL, NULL),
(7, 'kate', 'c4ca4238a0b923820dcc509a6f75849b', 'Kate', 'F.', 'Wiggin', 'user', 'kate.wiggin@hotmail.com', '1998-03-04', '2019-03-02', '2019-04-02 02:00:54', NULL),
(8, 'wilf', 'c4ca4238a0b923820dcc509a6f75849b', 'Wilfred', 'S.', 'Gilbert', 'user', 'wilf123@yahoo.com', '1966-03-03', '2019-03-05', NULL, NULL),
(9, 'edgar', 'c4ca4238a0b923820dcc509a6f75849b', 'Edgar', NULL, 'Owen', 'user', 'edgar@johnabbottcollege.net', '1987-02-06', '2019-03-08', NULL, NULL),
(10, 'henry', 'c4ca4238a0b923820dcc509a6f75849b', 'Henry', 'David', 'Thoreau', 'user', 'henry222@gmail.com', '1993-10-15', '2019-03-11', NULL, NULL),
(11, 'gaston', 'c4ca4238a0b923820dcc509a6f75849b', 'Gaston', NULL, 'Leroux', 'user', 'gaston092@facebook.com', '1990-01-01', '2019-03-12', NULL, NULL),
(12, 'victor', 'c4ca4238a0b923820dcc509a6f75849b', 'Victor', NULL, 'Leroux', 'user', 'gaston092@facebook.com', '2006-11-30', '2019-03-12', NULL, NULL),
(13, 'alexa', 'c4ca4238a0b923820dcc509a6f75849b', 'Alexandre', NULL, 'Dumas', 'user', 'alexa@gmail.com', '1990-03-15', '2019-03-13', NULL, NULL),
(14, 'mark', 'c4ca4238a0b923820dcc509a6f75849b', 'Mark', NULL, 'Dumas', 'user', 'alexa@gmail.com', '2005-08-17', '2019-03-13', NULL, NULL),
(15, 'mary', 'c4ca4238a0b923820dcc509a6f75849b', 'Mary', NULL, 'Dumas', 'user', 'alexa@gmail.com', '2008-06-03', '2019-03-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `booklist_view`
--
DROP TABLE IF EXISTS `booklist_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `booklist_view`  AS  select `b`.`ISBN` AS `ISBN`,`b`.`Title` AS `Title`,`b`.`Author` AS `Author`,`b`.`Publisher` AS `Publisher`,`b`.`Year` AS `Year`,`c`.`CategoryDescrip` AS `Category`,`l`.`LangDescrip` AS `Language`,`b`.`AgeRating` AS `AgeRating`,`b`.`BookStatus` AS `BookStatus`,`b`.`Description` AS `Description`,`b`.`BookImage` AS `BookImage` from ((`books` `b` join `categories` `c` on((`b`.`CategoryID` = `c`.`CategoryID`))) join `languages` `l` on((`b`.`LangID` = `l`.`LangID`))) order by `b`.`ISBN` ;

-- --------------------------------------------------------

--
-- Structure for view `loan_user_view`
--
DROP TABLE IF EXISTS `loan_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `loan_user_view`  AS  select `l`.`LoanID` AS `LoanID`,`l`.`ISBN` AS `ISBN`,`l`.`UserID` AS `UserID`,`u`.`UserName` AS `UserName`,`bv`.`Title` AS `Title`,`bv`.`Author` AS `Author`,`l`.`DateOut` AS `DateOut`,`l`.`DateDue` AS `DateDue`,`l`.`DateIn` AS `Datein`,`l`.`FineAssessed` AS `FineAssessed`,`l`.`FinePaid` AS `FinePaid`,`l`.`FineWaived` AS `FineWaived` from ((`loans` `l` join `users` `u` on((`l`.`UserID` = `u`.`UserID`))) join `booklist_view` `bv` on((`l`.`ISBN` = `bv`.`ISBN`))) order by `l`.`LoanID` desc ;

-- --------------------------------------------------------

--
-- Structure for view `reserve_user_view`
--
DROP TABLE IF EXISTS `reserve_user_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reserve_user_view`  AS  select `r`.`ReservID` AS `ReservID`,`r`.`ISBN` AS `ISBN`,`r`.`UserID` AS `UserID`,`u`.`UserName` AS `UserName`,`bv`.`Title` AS `Title`,`bv`.`Author` AS `Author`,`r`.`ReservDate` AS `ReservDate`,`r`.`ProcessedDate` AS `ProcessedDate`,`r`.`ReservStatus` AS `ReservStatus` from ((`reservations` `r` join `users` `u` on((`r`.`UserID` = `u`.`UserID`))) join `booklist_view` `bv` on((`r`.`ISBN` = `bv`.`ISBN`))) order by `r`.`ReservID` desc ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `fk_Books_Languages` (`LangID`),
  ADD KEY `fk_Books_Categories` (`CategoryID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`MsgID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`LangID`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`LoanID`),
  ADD KEY `fk_Loans_Books` (`ISBN`),
  ADD KEY `fk_Loans_Users` (`UserID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ReservID`),
  ADD KEY `fk_Reservations_Books` (`ISBN`),
  ADD KEY `fk_Reservations_Users` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ISBN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `MsgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `LoanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ReservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_Books_Categories` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`),
  ADD CONSTRAINT `fk_Books_Languages` FOREIGN KEY (`LangID`) REFERENCES `languages` (`LangID`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `fk_Loans_Books` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `fk_Loans_Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_Reservations_Books` FOREIGN KEY (`ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `fk_Reservations_Users` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
