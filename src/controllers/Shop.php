<?php
class Shop extends Controller
{
	public function __construct()
	{
		$this->portfolioModel = $this->model('Portfolio'); // load the model
		$this->navigationModel = $this->model('Navigation');
  }

	public function index($collection='', $artwork='')
	{
			$this->shop($collection, $artwork);
	}

	public function shop($collection, $artwork = '')
	{
		$stock = $this->portfolioModel->getCollectionDetails($collection);
		$data = (array) $stock;
		$data['art'] = $this->portfolioModel->getCollection($collection);
		$data['content'] = '<p>Hier vind je de prijzen van mijn kunstwerken. Klik op de prijs als je een werk wenst te kopen.<p>';
		if (!in_array($collection, $this->portfolioModel->getCollections())) {
			$artwork = $collection;
			$collection = $this->portfolioModel->getStock();
		}
		if ($artwork != '') {
			$art = $this->portfolioModel->getArtDetails($artwork, $collection);
		 	if (count($art) == 1) {
				header( 'refresh:0;url='.URLROOT.'/expo');
		 	}
			$data['art'] = $art;
		 	$data['title'] = $data['art']['title'].' - '.$data['art']['caption'];
		 	$data['nav'] = 'false'; // this turns the navigation off, should refactor this later
		 	$this->view('shop/detail', $data);
		 	die();
	 	}
		$this->view('shop/list', $data);
	}

	public function order($collection, $art)
	{
		$artwork = $this->portfolioModel->getArtDetails($art, $collection);
		$data = [
			'title'         => 'Bestellen bij Daanjels',
			'page'          => 'order',
			'menu'          => 'Expo',
			'wrap'          => 'concrete',
			'voornaam'      => "",
			'familienaam'   => "",
			'email'         => "",
			'telefoon'      => "",
			'bericht'       => "Ik ben geïnteresseerd om het schilderij ".$artwork['title']." te kopen voor ".$artwork['price']." euro.",
			'fout'          => "",
			'PH_voornaam'   => "Naam",
			'PH_familienaam' => "Familienaam",
			'PH_email'      => "E-mail",
			'PH_telefoon'   => "Telefoon",
			'PH_bericht'    => "",
			'retval'        => "",
			'art'						=> $artwork['title'],
			'path'					=> $artwork['path'],
			'url'						=> $artwork['url'],
			'collection'		=> $collection,
//			'accepted'			=> "Bedankt voor je bestelling.\nWeldra neemt da:njəls contact met je op voor de verdere afhandeling.\nDenk eraan dat het schilderij nog tot begin januari op de tentoonstelling blijft hangen."
			'accepted'			=> "Bedankt voor je bestelling.\nWeldra neemt da:njəls contact met je op voor de verdere afhandeling."
			];

	if (!empty($_POST)) {
		$data['voornaam'] = trim(filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING));
		$data['familienaam'] = trim(filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING));
		$data['email'] = trim(filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING));
		$data['telefoon'] = trim(filter_input(INPUT_POST, 'Telephone', FILTER_SANITIZE_STRING));
		$data['bericht'] = trim(filter_input(INPUT_POST, 'Message', FILTER_SANITIZE_STRING));
		
		if ($data['voornaam'] == '') { // geen voornaam ingevuld
				$data['PH_voornaam'] = "Je hebt je naam niet ingevuld...";
		} else if ($data['familienaam'] == '') { // geen familienaam ingevuld
				$data['PH_familienaam'] = "Je hebt je familienaam niet ingevuld...";
		} else if ($data['email'] == '') { // geen e-mail ingevuld
				$data['PH_email'] = "Je hebt je e-mailadres niet ingevuld...";
		} else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$data['fout_email'] = "Controleer je e-mail adres even, dat lijkt niet correct.";
		} else if ($data['bericht'] == '') { // geen bericht geschreven
				$data['PH_bericht'] = "Je hebt geen bericht geschreven !!";
		} else if (strlen($data['bericht']) > 1000) { // te lang bericht gemaakt
				$data['fout_bericht'] = "Je bericht bevat <strong>".strlen($data['bericht'])." </strong>tekens. Slechts 1000 toegelaten.";
		} else {
				$to = "info@daanjels.be";
				$subject = "Bestelling via de site";
				$message = $data['bericht'] . "\n" . $data['voornaam'] . " " . $data['familienaam'] . "\nTelefoonnummer: " . $data['telefoon'];
				$headers[] = "From: " . $data['email'];
				$headers[] = "Content-Type: text/plain; charset=utf-8";
				$header = implode("\r\n", $headers);
				$data['retval'] = mail ($to,$subject,$message,$header);
				if( $data['retval'] == true ) {
						// echo "<br/><br/><br/><pre>Message is being sent...</pre>";
						$this->portfolioModel->setArtSold($artwork['title']);
						header( 'refresh:10;url='.URLROOT.'/index' );
						// exit(0);
				} else {
						echo "Message could not be sent...";
				}
			}
		}

		$this->view('shop/order', $data);
	}

	public function pricelist($collection)
	{
		$stock = $this->portfolioModel->getCollectionDetails($collection);
		$data = (array) $stock;
		$data['content'] = '<p>Hier vind je de prijzen van mijn kunstwerken.</p>';
		$art = $this->portfolioModel->getCollection($collection);
		$data['art'] = $art;
		$this->view('shop/pricelist', $data);
	}

}