<?php
    use Symfony\Component\DomCrawler\Crawler;
    use Symfony\Component\HttpClient\HttpClient;

    function diffDate($date) {
        $newDate = explode(' s/d ', $date);
        $date1 = $newDate[0];
        $date2 = $newDate[1];

        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        $diff = $d1->diff($d2);
        return $diff->days . " hari";
    }

    function scrappingUniversitas()
    {
        $httpClient = HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]);

        // Initialize Crawler with cURL client
        $crawler = new Crawler(null, 'https://lldikti8.kemdikbud.go.id/daftar-pt/');
        $crawler->addHtmlContent($httpClient->request('GET', 'https://lldikti8.kemdikbud.go.id/daftar-pt/')->getContent());

        // Initialize an empty array to store the table rows data
        $tableRowsData = [];

        // Find and loop through all table rows
        $crawler->filter('#tablepress-1 tbody tr')->each(function (Crawler $row) use (&$tableRowsData) {
            // Get columns data from each row
            $columns = $row->filter('td')->each(function (Crawler $column) {
                return trim($column->text());
            });

            // Add columns data to the table rows data array
            $tableRowsData[] = $columns;
        });

        // Do something with the table rows data array
        return $tableRowsData;
    }








    //SCRAPPING UNIVERSITAS

    // use Illuminate\Support\Facades\Http;
    // use Sunra\PhpSimple\HtmlDomParser;
    // use \DOMDocument;
    // use \DOMXPath;
    // use Symfony\Component\DomCrawler\Crawler;

    // use Goutte\Client;
    // use App\Models\Pendaftaran;
    // use App\Models\Universitas;
    // use Illuminate\Http\Request;

    // public function index()
    // {
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.webometrics.info/en/Asia/Indonesia');

    //     $table = $crawler->filter('table')->eq(0);
    //     $headers = $table->filter('thead tr th')->each(function ($th) {
    //         return trim($th->text());
    //     });

    //     $rows = $table->filter('tbody tr')->each(function ($tr) use ($headers) {
    //         $cols = $tr->filter('td')->each(function ($td) {
    //             return trim($td->text());
    //         });

    //         return array_combine($headers, $cols);
    //     });

    //     // check if there is pagination
    //     $pagination = $crawler->filter('ul.pager');
    //     if ($pagination->count()) {
    //         $links = $pagination->filter('li a')->links();
    //         $currentPage = 31;
    //         $lastPage = 33;
    //         // while ($currentPage < $lastPage) {
    //         //     $currentPage++;
    //             $newCrawler = $client->request('GET', 'https://www.webometrics.info/en/Asia/Indonesia?page=35');
    
    //             $newTable = $newCrawler->filter('table')->eq(0);
    //             $newRows = $newTable->filter('tbody tr')->each(function ($tr) use ($headers) {
    //                 $cols = $tr->filter('td')->each(function ($td) {
    //                     return trim($td->text());
    //                 });

    //                 return array_combine($headers, $cols);
    //             });
    
    //             $rows = array_merge($rows, $newRows);
    //         // }
    //     }
    //     dd($rows);
    //     // output scraped data
    //     foreach ($rows as $d) {
    //         Universitas::create([
    //             'ranking' => $d['ranking'],
    //             'world_rank' => $d['World Rank'],
    //             'university' => $d['University'],
    //             'impact_rank' => $d['Impact Rank*'],
    //             'openness_rank' => $d['Openness Rank*'],
    //             'excellence_rank' => $d['Excellence Rank*'],
    //         ]);
    //     }

    // }

    // public function indexPagination()
    // {
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.webometrics.info/en/Asia/Indonesia');

    //     $table = $crawler->filter('table')->eq(0);
    //     $headers = $table->filter('thead tr th')->each(function ($th) {
    //         return trim($th->text());
    //     });

    //     $rows = $table->filter('tbody tr')->each(function ($tr) use ($headers) {
    //         $cols = $tr->filter('td')->each(function ($td) {
    //             return trim($td->text());
    //         });

    //         return array_combine($headers, $cols);
    //     });

    //     // check if there is pagination
    //     $pagination = $crawler->filter('ul.pager');
    //     if ($pagination->count()) {
    //         $links = $pagination->filter('li a')->links();
    //         dd($links);
    //         foreach ($links as $link) {
    //             $newCrawler = $client->click($link);
    //             $newTable = $newCrawler->filter('table')->eq(0);
    //             $newRows = $newTable->filter('tbody tr')->each(function ($tr) use ($headers) {
    //                 $cols = $tr->filter('td')->each(function ($td) {
    //                     return trim($td->text());
    //                 });

    //                 return array_combine($headers, $cols);
    //             });

    //             $rows = array_merge($rows, $newRows);
    //         }
    //     }

    //     // output scraped data
    //     dd($rows);
    // }

    // public function indexFix()
    // {
    //     $client = new Client();
    //     $crawler = $client->request('GET', 'https://www.webometrics.info/en/Asia/Indonesia');

    //     $table = $crawler->filter('table')->eq(0);
    //     $headers = $table->filter('thead tr th')->each(function ($th) {
    //         return trim($th->text());
    //     });

    //     $rows = $table->filter('tbody tr')->each(function ($tr) use ($headers) {
    //         $cols = $tr->filter('td')->each(function ($td) {
    //             return trim($td->text());
    //         });

    //         return array_combine($headers, $cols);
    //     });

    //     dd($rows);
    // }