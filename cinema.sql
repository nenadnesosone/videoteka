-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2019 at 03:54 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `MovieId` int(11) NOT NULL,
  `Title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `ReleaseYear` year(4) NOT NULL,
  `Genre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Director` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LeadingActor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Summary` longtext COLLATE utf8_unicode_ci,
  `ImdbRating` decimal(2,0) NOT NULL,
  `PosterUrl` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl_1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl_2` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl_3` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl_4` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ImageUrl_5` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`MovieId`, `Title`, `ReleaseYear`, `Genre`, `Director`, `LeadingActor`, `Country`, `Language`, `Summary`, `ImdbRating`, `PosterUrl`, `ImageUrl_1`, `ImageUrl_2`, `ImageUrl_3`, `ImageUrl_4`, `ImageUrl_5`) VALUES
(1, 'Howl\'s Moving Castle', 2004, 'Animation', 'Hayao Miyazaki', 'Takuya Kimura, Chieko Baish', 'Japan', 'Japanese', 'A love story between an 18-year-old girl named Sophie, cursed by a witch into an old woman\'s body, and a magician named Howl. Under the curse, Sophie sets out to seek her fortune, which takes her to Howl\'s strange moving castle. In the castle, Sophie meets Howl\'s fire demon, named Karishifa. Seeing that she is under a curse, the demon makes a deal with Sophie--if she breaks the contract he is under with Howl, then Karushifa will lift the curse that Sophie is under, and she will return to her 18-year-old shape.', '8', 'images/Posters/HowlsMovingCastle.jpg', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HowlsMovingCastle/howl1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HowlsMovingCastle/howl2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HowlsMovingCastle/howl3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HowlsMovingCastle/howl4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HowlsMovingCastle/howl5.jpg?raw=true'),
(2, 'The Abyss', 1989, 'Adventure', 'James Cameron', 'Ed Harris, Mary Elizabeth Mastrantonio', 'USA', 'English', 'Formerly married petroleum engineers who still have some issues to work out. They are drafted to assist a gung-ho Navy SEAL with a top-secret recovery operation: a nuclear sub has been ambushed and sunk, under mysterious circumstances, in some of the deepest waters on Earth.', '8', 'images/Posters/TheAbyss.jpg', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheAbyss/abyss1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheAbyss/abyss2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheAbyss/abyss3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheAbyss/abyss4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheAbyss/abyss5.jpg?raw=true'),
(3, 'Run Lola Run', 1998, 'Crime', 'Tom Tykwer', 'Franka Potente,  Moritz Bleibtreu', 'Germany', 'German', 'Lola receives a phone call from her boyfriend Manni. He lost 100,000 DM in a subway train that belongs to a very bad guy. Lola has 20 min to raise this amount and meet Manni. Otherwise, he will rob a store to get the money. Three different alternatives may happen depending on some minor event along Lola\'s run.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/RunLolaRun.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RunLolaRun/lola1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RunLolaRun/lola2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RunLolaRun/lola3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RunLolaRun/lola4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RunLolaRun/lola5.jpg?raw=true'),
(4, 'Cube', 1997, 'Sci-Fi', 'Vincenzo Natali', 'Nicole de Boer, Maurice Dean Wint', 'Canada', 'English', 'Six different people, each from a very different walk of life, awaken to find themselves inside a giant cube with thousands of possible rooms. Each has a skill that becomes clear when they must band together to get out: a cop, a math whiz, a building designer, a doctor, an escape master, and a disabled man. Each plays a part in their thrilling quest to find answers as to why they\'ve been imprisoned.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Cube.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Cube/cube1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Cube/cube2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Cube/cube3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Cube/cube4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Cube/cube5.jpg?raw=true'),
(5, 'Amelie', 2001, 'Romance', 'Jean-Pierre Jeunet', 'Audrey Tautou, Mathieu Kassovitz', 'France', 'French', 'Amelie is a story about a girl named Amelie whose childhood was suppressed by her Father\'s mistaken concerns of a heart defect. With these concerns Amelie gets hardly any real life contact with other people. This leads Amelie to resort to her own fantastical world and dreams of love and beauty. She later on becomes a young woman and moves to the central part of Paris as a waitress. After finding a lost treasure belonging to the former occupant of her apartment, she decides to return it to him. After seeing his reaction and his new found perspective - she decides to devote her life to the people around her. Such as, her father who is obsessed with his garden-gnome, a failed writer, a hypochondriac, a man who stalks his ex girlfriends, the \"ghost\", a suppressed young soul, the love of her life and a man whose bones are as brittle as glass. But after consuming herself with these escapades - she finds out that she is disregarding her own life and damaging her quest for love. Amelie then discovers she must become more aggressive and take a hold of her life and capture the beauty of love she has always dreamed of.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Amelie.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Amelie/amelie1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Amelie/amelie2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Amelie/amelie3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Amelie/amelie4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Amelie/amelie5.jpg?raw=true'),
(6, 'Despicable Me', 2010, 'Animation, Comedy', 'Pierre Coffin, Chris Renaud', 'Steve Carell,Russell Brand', 'USA', 'English', 'In a happy suburban neighborhood surrounded by white picket fences with flowering rose bushes, sits a black house with a dead lawn. Unbeknownst to the neighbors, hidden beneath this home is a vast secret hideout. Surrounded by a small army of minions, we discover Gru, planning the biggest heist in the history of the world. He is going to steal the moon. (Yes, the moon!) Gru delights in all things wicked. Armed with his arsenal of shrink rays, freeze rays, and battle-ready vehicles for land and air, he vanquishes all who stand in his way. Until the day he encounters the immense will of three little orphaned girls who look at him and see something that no one else has ever seen: a potential Dad. The world\'s greatest villain has just met his greatest challenge: three little girls named Margo, Edith and Agnes.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/DespicableMe.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/DespicableMe/despicable1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/DespicableMe/despicable2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/DespicableMe/despicable3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/DespicableMe/despicable4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/DespicableMe/despicable5.jpg?raw=true'),
(7, 'Gladiator', 2000, 'Action', 'Ridley Scott', 'Russell Crowe, Joaquin Phoenix', 'USA', 'English', 'Maximus is a powerful Roman general, loved by the people and the aging Emperor, Marcus Aurelius. Before his death, the Emperor chooses Maximus to be his heir over his own son, Commodus, and a power struggle leaves Maximus and his family condemned to death. The powerful general is unable to save his family, and his loss of will allows him to get captured and put into the Gladiator games until he dies. The only desire that fuels him now is the chance to rise to the top so that he will be able to look into the eyes of the man who will feel his revenge.', '9', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Gladiator.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Gladiator/gladiator1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Gladiator/gladiator2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Gladiator/gladiator3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Gladiator/gladiator4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Gladiator/gladiator5.jpg?raw=true'),
(8, 'Signs', 2002, 'Sci-Fi', 'M. Night Shyamalan', 'Mel Gibson, Joaquin Phoenix', 'USA', 'English', 'Preacher Graham Hess, played by Mel Gibson, has lost his faith in God after his wife dies in a brutal car accident. He along with his son and daughter and his brother Merrill lives in a farmhouse. Crop circles begin to appear in their corn fields which Graham dismisses as mischief by miscreants. After hearing strange noises and watching news coverage on crop circles appearing all over the world, the family grows suspicious of alien activities. Now they must stick together and believe, as a family to survive the ordeal and find a way to escape.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Signs.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Signs/signs1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Signs/signs2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Signs/signs3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Signs/signs4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Signs/signs5.jpg?raw=true'),
(9, 'Joker', 2019, 'Crime', 'Todd Phillips', 'Joaquin Phoenix, Robert De Niro', 'USA', 'English', 'Joker centers around an origin of the iconic arch nemesis and is an original, standalone story not seen before on the big screen. Todd Phillips\' exploration of Arthur Fleck (Joaquin Phoenix), a man disregarded by society, is not only a gritty character study, but also a broader cautionary tale.', '9', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Joker.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Joker/joker1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Joker/joker2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Joker/joker3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Joker/joker4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Joker/joker5.jpg?raw=true'),
(10, 'Ikke naken', 2004, 'Romance', 'Torun Lian', 'Lars Brunborg, Tobias Boksle', 'Norway', 'Norwegian', 'Selma\'s mother died giving birth to her, and Selma\'s step aunt is living proof that men only cause trouble. So the 11 year old girl makes a deal with her best friends that they will stay away from boys and dedicate their lives to science. And by the way, Selma was probably born on another planet and not meant to fall in love with anyone. But what happens when her friends break the pact, and she actually meets a boy who\'s not like the rest? A beautiful story about exploring and finding out about life and what you want, and how difficult it can be sometimes. Especially when \"nature\" works against your principles and beliefs...', '6', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/IkkeNaken.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IkkeNaken/milk1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IkkeNaken/milk2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IkkeNaken/milk3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IkkeNaken/milk4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IkkeNaken/milk5.jpg?raw=true'),
(11, 'Dune', 1984, 'Sci-Fi', 'David Lynch', 'Kyle MacLachlan, Virginia Madsen', 'USA', 'English', 'In the distant year of 10191, all the planets of the known Universe are under the control of Padishah Emperor Shaddam IV and the most important commodity in the Universe is a substance called the spice \"MELANGE\" which is said to have the power of extending life, expanding the consciousness and even to \"fold space\" ; being able to travel to any distance without physically moving. This spice \"MELANGE\" is said to only be produced in the desert planet of Arrakis, where the FREMEN people have the prophecy of a man who will lead them to true freedom. This \"desert planet\"of Arrakis is also known as DUNE. A secret report of the space \"GUILD\" talks about some circumstances and plans that could jeopardize the production of \"SPICE\"', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Dune.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Dune/dune1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Dune/dune2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Dune/dune3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Dune/dune4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Dune/dune5.jpg?raw=true'),
(12, 'The Hunger Games: Catching Fire', 2013, 'Sci-Fi', 'Francis Lawrence', 'Jennifer Lawrence, Josh Hutcherson', 'USA', 'English', 'Twelve months after winning the 74th Hunger Games, Katniss Everdeen and her partner Peeta Mellark must go on what is known as the Victor\'s Tour, wherein they visit all the districts, but before leaving, Katniss is visited by President Snow who fears that Katniss defied him a year ago during the games when she chose to die with Peeta. With both Katniss and Peeta declared the winners, it is fueling a possible uprising. He tells Katniss that while on tour she better try to make sure that she puts out the flames or else everyone she cares about will be in danger.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/CatchingFire.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/CatchingFire/fire1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/CatchingFire/fire2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/CatchingFire/fire3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/CatchingFire/fire4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/CatchingFire/fire5.jpg?raw=true'),
(13, 'Girl, Interrupted', 1999, 'Drama', 'James Mangold', 'Winona Ryder, Angelina Jolie', 'USA', 'English', 'Unable to cope with reality and the difficulty that comes with it, 18 year old Susanna, is admitted to a mental institution in order to overcome her disorder. However, she has trouble understanding her disorder and therefore finds it difficult to tame, especially when she meets the suggestive and unpredictable Lisa.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/GirlInterrupted.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/GirlInterupted/girl1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/GirlInterupted/girl2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/GirlInterupted/girl3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/GirlInterupted/girl4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/GirlInterupted/girl5.jpg?raw=true'),
(14, 'The Hunger Games', 2012, 'Sci-Fi', 'Gary Ross', 'Jennifer Lawrence, Josh Hutcherson', 'USA', 'English', 'In a dystopian future, the totalitarian nation of Panem is divided into 12 districts and the Capitol. Each year two young representatives from each district are selected by lottery to participate in The Hunger Games. Part entertainment, brutal retribution for a past rebellion, the televised games are broadcast throughout Panem. The 24 participants are forced to eliminate their competitors while the citizens of Panem are required to watch. When 16-year-old Katniss\' young sister, Prim, is selected as District 12\'s female representative, Katniss volunteers to take her place. She and her male counterpart, Peeta, are pitted against bigger, stronger representatives, some of whom have trained for this their whole lives.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/HungerGames.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HungerGames/hunger1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HungerGames/hunger2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HungerGames/hunger3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HungerGames/hunger4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/HungerGames/hunger5.jpg?raw=true'),
(15, 'Indiana Jones and the Last Crusade', 1989, 'Adventure', 'Steven Spielberg', 'Harrison Ford, Sean Connery', 'USA', 'English', 'An art collector appeals to Indiana Jones to embark on a search for the Holy Grail. He learns that another archaeologist has disappeared while searching for the precious goblet, and the missing man is his own father, Dr. Henry Jones. The artifact is much harder to find than they expected, and its powers are too much for those impure of heart.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/IndianaJones.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IndianaJones/indiana1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IndianaJones/indiana2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IndianaJones/indiana3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IndianaJones/indiana4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/IndianaJones/indiana5.jpg?raw=true'),
(16, 'Kika', 1993, 'Comedy', 'Pedro Almodovar', 'Veronica Forque, Victoria Abril', 'Spain', 'Spanish', 'Kika, a young cosmetologist, is called to the mansion of Nicolas, an American writer to make-up the corpse of his stepson, Ramon. Ramon, who is not dead, is revived by Kika\'s attentions and she then moves in with him. They might live happily ever after but first they have to cope with Kika\'s affair with Nicolas, the suspicious death of Ramon\'s mother and the intrusive gaze of tabloid-TV star and Ramon\'s ex-psychologist Andrea Scarface.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Kika.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Kika/kika1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Kika/kika2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Kika/kika3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Kika/kika4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Kika/kika5.jpg?raw=true'),
(17, 'Matador', 1986, 'Thriller', 'Pedro Almodovar', 'Assumpta Serna, Antonio Banderas', 'Spain', 'Spanish', 'An ex-bullfighter who gets turned on by killing, a lady lawyer with the same fetish and a young man driven insane by his religious upbringing - these are the main characters in this stylish black comedy about dark sides of human nature.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Matador.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Matador/matador1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Matador/matador2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Matador/matador3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Matador/matador4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/Matador/matador5.jpg?raw=true'),
(18, 'The Hunger Games: Mockingjay - Part 1', 2014, 'Sci-Fi', 'Francis Lawrence', 'Jennifer Lawrence, Josh Hutcherson', 'USA', 'English', 'With the Games destroyed, Katniss Everdeen, along with Gale, Finnick and Beetee, end up in the so thought \"destroyed\" District 13. Under the leadership of President Coin and the advice of her friends, Katniss becomes the \"Mockingjay\", the symbol of rebellion for the districts of Panem.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Mockingjay1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay1/m_jay1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay1/m_jay2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay1/m_jay3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay1/m_jay4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay1/m_jay5.jpg?raw=true'),
(19, 'The Hunger Games: Mockingjay - Part 2', 2015, 'Sci-Fi', 'Francis Lawrence', 'Jennifer Lawrence, Josh Hutcherson', 'USA', 'English', 'After young Katniss Everdeen agrees to be the symbol of rebellion, the Mockingjay, she tries to return Peeta to his normal state, tries to get to the Capitol, and tries to deal with the battles coming her way...but all for her main goal: assassinating President Snow and returning peace to the Districts of Panem. As her squad starts to get smaller and smaller, will she make it to the Capitol? Will she get revenge on Snow or will her target change? Will she be with her \"Star-Crossed Lover,\" Peeta, or her long-time friend, Gale? Deaths, bombs, bow and arrows, a love triangle, hope...', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/Mockingjay2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay2/m_jay_2_1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay2/m_jay_2_2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay2/m_jay_2_3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay2/m_jay_2_4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/MockingJay2/m_jay_2_5.jpg?raw=true'),
(20, 'Rogue One: A Star Wars Story', 2016, 'Sci-Fi', 'Gareth Edwards', 'Felicity Jones, Diego Luna', 'USA', 'English', 'All looks lost for the Rebellion against the Empire as they learn of the existence of a new super weapon, the Death Star. Once a possible weakness in its construction is uncovered, the Rebel Alliance must set out on a desperate mission to steal the plans for the Death Star. The future of the entire galaxy now rests upon its success.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/RogueOne.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RogueOne/rogue1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RogueOne/rogue2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RogueOne/rogue3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RogueOne/rogue4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/RogueOne/rogue5.jpg?raw=true'),
(21, 'The Flower of My Secret', 1995, 'Drama', 'Pedro Almodovar', 'Marisa Paredes, Juan Echanove', 'Spain', 'Spanish', 'Leo Macias writes sentimental novels with great success but hidden under a pseudonym, Amanda Gris. She is unhappy with her professional life and with her husband, a soldier working in Brussels and Bosnia that is never at home. She will try anything to change her life.', '7', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/TheFlowerOfMySecret.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheFlowerOfMySecret/la_flor1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheFlowerOfMySecret/la_flor2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheFlowerOfMySecret/la_flor3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheFlowerOfMySecret/la_flor4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheFlowerOfMySecret/la_flor5.jpg?raw=true'),
(22, 'The Man Without a Past', 2002, 'Comedy', 'Aki Kaurismaki', 'Markku Peltola, Kati Outinen', 'Finland', 'Finnish', 'The second part of Aki Kaurismaki\'s \"Finland\" trilogy, the film follows a man who arrives in Helsinki and gets beaten up so severely he develops amnesia. Unable to remember his name or anything from his past life, he cannot get a job or an apartment, so he starts living on the outskirts of the city and slowly starts putting his life back on track.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/TheManWithoutAPast.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheManWithoutPast/man1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheManWithoutPast/man2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheManWithoutPast/man3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheManWithoutPast/man4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TheManWithoutPast/man5.jpg?raw=true'),
(23, 'Crouching Tiger, Hidden Dragon', 2000, 'Fantasy', 'Ang Lee', 'Yun-Fat Chow, Michelle Yeoh', 'Taiwan', 'Mandarin', 'In 19th century Qing Dynasty China, a warrior gives his sword, Green Destiny, to his friend to deliver to safe keeping, but it is stolen, and the chase is on to find it. The search leads to the House of Yu where the story takes on a whole different level.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/TigerDragon.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TigerDragon/tiger1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TigerDragon/tiger2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TigerDragon/tiger3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TigerDragon/tiger4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/TigerDragon/tiger5.jpg?raw=true'),
(24, 'Y Tu Mama Tambien', 2001, 'Drama', 'Alfonso Cuaron', ' Gael Garcia Bernal, Daniel Gimenez Cacho', 'Mexico', 'Spanish', 'In Mexico City, late teen friends Tenoch Iturbide and Julio Zapata are feeling restless as their respective girlfriends are traveling together through Europe before they all begin the next phase of their lives at college. At a lavish family wedding, Tenoch and Julio meet Luisa Cortes, the twenty-something wife of Tenoch\'s cousin Jano, the two who have just moved to Mexico from Spain. Tenoch and Julio try to impress the beautiful Luisa by telling her that they will be taking a trip to the most beautiful secluded beach in Mexico called la Boca del Cielo (translated to Heaven\'s Mouth), the trip and the beach which in reality don\'t exist. When Luisa learns of Jano\'s latest marital indiscretion straight from the horse\'s mouth, she takes Tenoch and Julio\'s offer to go along on this road trip, meaning that Tenoch and Julio have to pull together quickly a road trip to a non-existent beach.', '8', 'https://github.com/nenadnesosone/videoteka/blob/master/images/Posters/YTuMamaTambien.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/YTuMamaTambien/mama1.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/YTuMamaTambien/mama2.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/YTuMamaTambien/mama3.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/YTuMamaTambien/mama4.jpg?raw=true', 'https://github.com/nenadnesosone/videoteka/blob/master/images/movie_images/YTuMamaTambien/mama5.jpg?raw=true');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`email`, `token`, `expDate`) VALUES
('ljubica@gmail.com', 'ocwmsfss0a', '2019-10-14 22:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `RegistrationDate` date DEFAULT NULL,
  `ProfilePicture` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`UserId`, `FirstName`, `LastName`, `UserName`, `Email`, `Password`, `RegistrationDate`, `ProfilePicture`) VALUES
(1, 'Danica2', 'R', 'Rasha', 'IT.obuka.danica@gmail.com', 'a43d9e4fb22287ba625f4671e9dc89e807a4b07f18e858bacbe6d70e8dba5ec5', '2019-09-12', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/woman_128.png?raw=true'),
(2, 'Natalija', 'B', 'Natalie', 'IT.obuka.natalija@gmail.com', '0f0049e60f68337025ac710e879a6cc6173391f3dcea958ecf7a1feb003efa00', '2019-10-07', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/avatar%20(1)_128.png?raw=true'),
(3, 'Ljubica', 'Z', 'Ljubica', 'IT.obuka.ljubica@gmail.com', '955212af962c31b3eaacda801e8fd247e29a67e14f0e1f44d462de16d8d9da73', '2019-10-07', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/avatar%20(2)_128.png?raw=true'),
(4, 'Andjelka', 'A', 'Andjelka', 'IT.obuka.andjelka@gmail.com', '2d51039c939e42ff0c212a28dbc9701fe46aeb4d2161ffff29524aac7c410f87', '2019-10-07', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/avatar%20(3)_128.png?raw=true'),
(5, 'Nenad', 'M', 'Nesa', 'IT.obuka.nenad@gmail.com', '81fe2e8c9683416384a2942af69d18712435f333b710723f62676245be7d5979', '2019-10-07', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/avatar_128.png?raw=true'),
(6, 'Ljubica', 'Zeravic', 'ljubica_zeravic', 'ljubica@gmail.com', 'a3bf9648867756398784b458496abd09', '2019-10-13', 'https://github.com/nenadnesosone/videoteka/blob/master/images/profile_pictures/woman_128.png?raw=true');

-- --------------------------------------------------------

--
-- Table structure for table `users_movies`
--

CREATE TABLE `users_movies` (
  `UserId` int(11) NOT NULL,
  `MovieId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_movies`
--

INSERT INTO `users_movies` (`UserId`, `MovieId`) VALUES
(1, 1),
(1, 5),
(1, 6),
(1, 10),
(1, 22),
(1, 24),
(2, 3),
(2, 13),
(2, 16),
(2, 17),
(3, 5),
(3, 21),
(3, 23),
(4, 11),
(4, 23),
(5, 2),
(5, 7),
(5, 9),
(5, 15),
(5, 20),
(6, 16),
(6, 17),
(6, 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`MovieId`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `users_movies`
--
ALTER TABLE `users_movies`
  ADD PRIMARY KEY (`UserId`,`MovieId`),
  ADD KEY `Movie_idx` (`MovieId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `MovieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users_data` (`Email`);

--
-- Constraints for table `users_movies`
--
ALTER TABLE `users_movies`
  ADD CONSTRAINT `MovieFK` FOREIGN KEY (`MovieId`) REFERENCES `movies` (`MovieId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserFK` FOREIGN KEY (`UserId`) REFERENCES `users_data` (`UserId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
