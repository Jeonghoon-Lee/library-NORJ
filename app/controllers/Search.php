<?php
// books.php
  class Search extends Controller {
    // define Model variable
    private $books;
    private $languages;
    private $categories;

    function __construct() {
      parent::__construct();
      // initialize Models
      $this->books = new BookViewModel($this->db); 
      $this->languages = new LangModel($this->db); 
      $this->categories = new CategoryModel($this->db); 
    }

    function search_book($f3) {
      $render_option = array(
        'session' => $f3->get('SESSION'),
        'languages' => $this->languages->fetch_all(),
        'categories' => $this->categories->fetch_all(),
        'min_year' => 1980
      );
      echo $f3->get('twig')->render('search.html', $render_option);
    }

    function search_result($f3) {
      if (sizeof($f3->get('GET')) > 0) {
        // create query
        $keyword = trim($f3->get('GET.keyword'));

        $search_options = 'Title like "%' . $keyword . '%"' . ' or '
                          . 'Author like "%' . $keyword . '%"' . ' or '
                          . 'Category like "%' . $keyword . '%"' . ' or '
                          . 'Language like "%' . $keyword . '%"';
        
        $render_option = array(
          'session' => $f3->get('SESSION'),
          'subtitle' => 'Search Result',
          'books' => $this->books->find_book($search_options)
        );
        echo $f3->get('twig')->render('search_result.html', $render_option);
      } else {
        // for admin user mode
        // after inserting book, display list of books.
        if ($f3->get('SESSION.booklist') == 'on') {
          $f3->set('SESSION.booklist', '');   // clear

          // order by not working in MySQL view
          // array_reverse to display recent to old
          $render_option = array(
            'session' => $f3->get('SESSION'),
            'subtitle' => 'Book List',
            'books' => $this->books->fetch_all()
            // 'books' => array_reverse($this->books->fetch_all())
          );          
          echo $f3->get('twig')->render('search_result.html', $render_option);
        } else {
          // go to detail search page
          $f3->reroute('/search');
        }
      }
    }

    function detail_search_result($f3) {
      // for testing
      // echo '<pre>';
      // echo print_r($f3->get('POST'));
      // echo '</pre>';
      
      // validation check for year value
      if (($f3->get('POST.From') != '') && (!is_numeric($f3->get('POST.From')))) {
        $f3->reroute('');
      } else if (($f3->get('POST.From') != '') && (!is_numeric($f3->get('POST.From')))) {
        $f3->reroute('');
      }

      // no error, make search string
      $search_options = [];

      $search_keys = '';
      $keywords = [];
      for ($i=1; $i<=3 ; $i++) {
        if ($f3->get('POST.keyword' . $i) != null) {
          $search_value = '';
          if ($f3->get('POST.match' . $i) == 0) {
            $search_value = '"%' . $f3->get('POST.keyword' . $i) . '%"';
          } else {
            $search_value = '"' . $f3->get('POST.keyword' . $i) . '"';
          }

          if ($f3->get('POST.field' . $i) == 'All') {
            $keywords[$i] = '(' . 'Title like ' . $search_value . ' or '
                        . 'Author like ' . $search_value . ' or '
                        . 'Publisher like ' . $search_value . ' or '
                        . 'Description like ' . $search_value . ')';
          } else {
            $keywords[$i] = '(' . $f3->get('POST.field' . $i) . ' like ' . $search_value . ')';
          }
          if ($i > 1) {
            if ($search_keys != '') {
              if ($f3->get('POST.operator' . ($i-1)) == 'not') {
                $search_keys = $search_keys . ' and not ' . $keywords[$i];
              } else {
                $search_keys = $search_keys . ' ' . $f3->get('POST.operator' . ($i-1)) . ' ' . $keywords[$i];
              }
            } else {
              $search_keys = $keywords[$i];
            }
          } else {
            $search_keys = $keywords[$i];
          }
        } else {
          $keywords[$i] = '';
        }
      }
      if ($search_keys != '')
        $search_options[] = '(' . $search_keys . ')';

      // AgeRating
      $rating = '';
      if ($f3->get('POST.adult') && $f3->get('POST.child')) {
        $rating = '';     // select all
      } else if ($f3->get('POST.adult')) {
        $rating = 'AgeRating = 1';
      } else if ($f3->get('POST.child')) {
        $rating = 'AgeRating = 0';
      }
      if ($rating != '')
        $search_options[] = '(' . $rating . ')';

      // Languages
      $lang_options= '';
      for ($i=1; $i<=7 ; $i++) { 
        if ($f3->get('POST.lang' . $i)) {
          $search_value = '(Language = "' . $f3->get('POST.lang' . $i) . '")';
          if ($lang_options != '') {
            $lang_options = $lang_options . ' or ' . $search_value;
          } else {
            $lang_options = $search_value;
          }
        }
      }
      if ($lang_options != '')
        $search_options[] = '(' . $lang_options . ')';

      // Categories
      $cate_options= '';
      for ($i=1; $i<=12 ; $i++) { 
        if ($f3->get('POST.cate' . $i)) {
          $search_value = '(Category = "' . $f3->get('POST.cate' . $i) . '")';
          if ($cate_options != '') {
            $cate_options = $cate_options . ' or ' . $search_value;
          } else {
            $cate_options = $search_value;
          }
        }
      }      
      if ($cate_options != '')
        $search_options[] = '(' . $cate_options . ')';

      if (($f3->get('POST.From') != '') and ($f3->get('POST.To') != '')) {
        if ($f3->get('POST.From') < $f3->get('POST.To')) {
          $search_options[] = '(Year between ' . $f3->get('POST.From') . ' and ' . $f3->get('POST.To') . ')';
        } else {
          $search_options[] = '(Year between ' . $f3->get('POST.To') . ' and ' . $f3->get('POST.From') . ')';
        }
      }

      // for testing
      // echo '<pre>';
      // echo print_r($search_options);
      // echo '</pre>';  

      $render_option = array(
        'session' => $f3->get('SESSION'),
        'subtitle' => 'Advanced Search Result',
        'books' => $this->books->find_book(implode(' and ', $search_options))
      );
      echo $f3->get('twig')->render('search_result.html', $render_option);
    }

    function get_detail($f3) {
      $ISBN = $f3->get('PARAMS.ISBN');    // get ISBN     
      $book = $this->books->find_by_isbn($ISBN);

      $render_option = array(
        'session' => $f3->get('SESSION'),
        'book' => $book
      );      
      echo $f3->get('twig')->render('book_detail.html', $render_option);
    }    
  }
?>
