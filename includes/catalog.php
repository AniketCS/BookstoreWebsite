<?php
function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
    echo html($text);
}

$catalog = array(
    'children' => array(
        array(
            'isbn' => '978-0399226908',
            'cover_image' => 'hungry_caterpillar.jpg',
            'author' => 'Eric Carle',
            'title' => 'The Very Hungry Caterpillar',
            'price' => 14.99,
            'year' => 1969,
            'genres' => array('Children', 'Educational'),
        ),
        array(
            'isbn' => '978-0694003617',
            'cover_image' => 'goodnight_moon.jpg',
            'author' => 'Margaret Wise Brown',
            'title' => 'Goodnight Moon',
            'price' => 10.99,
            'year' => 1947,
            'genres' => array('Children'),
        ),
        array(
            'isbn' => '978-0064431781',
            'cover_image' => 'wild_things.jpg',
            'author' => 'Maurice Sendak',
            'title' => 'Where the Wild Things Are',
            'price' => 9.95,
            'year' => 1963,
            'genres' => array('Children', 'Adventure'),
        ),
        array(
            'isbn' => '978-0670867332',
            'cover_image' => 'the_snowy_day.jpg',
            'author' => 'Ezra Jack Keats',
            'title' => 'The Snowy Day',
            'price' => 10.99,
            'year' => 1962,
            'genres' => array('Children'),
        ),
        array(
            'isbn' => '978-0590353427',
            'cover_image' => 'sorcerers_stone.png',
            'author' => 'J.K. Rowling',
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'price' => 55.99,
            'year' => 1997,
            'genres' => array('Children', 'Fantasy'),
        )
        
    ),
    'educational' => array(
        array(
            'isbn' => '978-0205309023',
            'cover_image' => 'elements_of_style.jpg',
            'author' => 'William Strunk Jr. and E.B. White',
            'title' => 'The Elements of Style',
            'price' => 7.20,
            'year' => 1918,
            'genres' => array('Educational'),
        ),
        array(
            'isbn' => '978-0553052435',
            'cover_image' => 'brief_history_of_time.jpg',
            'author' => 'Stephen Hawking',
            'title' => 'A Brief History of Time',
            'price' => 19.99,
            'year' => 1988,
            'genres' => array('Educational', 'Science'),
        ),
        array(
            'isbn' => '978-0771038518',
            'cover_image' => 'sapiens.jpg',
            'author' => 'Yuval Noah Harari',
            'title' => 'Sapiens: A Brief History of Humankind',
            'price' => 22.99,
            'year' => 2014,
            'genres' => array('Educational', 'History'),
        ),
        array(
            'isbn' => '978-1599869773',
            'cover_image' => 'art_of_war.jpg',
            'author' => 'Sun Tzu',
            'title' => 'The Art of War',
            'price' => 7.99,
            'year' => 'Ancient China (estimated around 5th century BCE)',
            'genres' => array('Educational'),
        ),
        array(
            'isbn' => '978-0345539434',
            'cover_image' => 'cosmos.jpeg',
            'author' => 'Carl Sagan',
            'title' => 'Cosmos',
            'price' => 20.05,
            'year' => 1980,
            'genres' => array('Educational', 'Science'),
        )
        
    ),
    'puzzles' => array(
        array(
            'isbn' => '978-1544218892',
            'cover_image' => 'sudoku_puzzle.jpg',
            'author' => 'Puzzlemaster',
            'title' => 'Sudoku Puzzle Book',
            'price' => 9.99,
            'year' => 2006,
            'genres' => array('Puzzle'),
        ),
        array(
            'isbn' => '978-1580421829',
            'cover_image' => 'chess_puzzles.jpg',
            'author' => 'Fred Wilson and Bruce Albertson',
            'title' => '303 more tricky chess puzzles',
            'price' => 9.99,
            'year' => 1991,
            'genres' => array('Puzzle'),
        ),
        array(
            'isbn' => '978-1645582670',
            'cover_image' => 'large_print.jpg',
            'author' => 'Publications International Ltd',
            'title' => 'Brain Games - Large Print Sudoku',
            'price' => 17.99,
            'year' => 2020,
            'genres' => array('Puzzle'),
        ),
        array(
            'isbn' => '0958257450',
            'cover_image' => 'crossword_challenge.jpg',
            'author' => 'Basil Carryer',
            'title' => 'Crossword Challenge: 100 Puzzles',
            'price' => 9.54,
            'year' => 2023,
            'genres' => array('Puzzle'),
        ),
        array(
            'isbn' => '979-8887680019',
            'cover_image' => 'brain_games.jpg',
            'author' => 'Donovan Ellis',
            'title' => 'The Ultimate Brain Games ',
            'price' => 14.99,
            'year' => 2022,
            'genres' => array('Puzzle'),
        )
    )
);
?>
