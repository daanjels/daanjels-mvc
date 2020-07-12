<?php
class Portfolios extends Controller
{
    public function __construct()
    {
        $this->portfolioModel = $this->model('Portfolio'); // load the user model
    }

    public function index()
    {
        $this->portrait();
    }
    public function portrait()
    {
        $data = [
            'title' => 'Portraits by Daanjels',
            'page' => 'portrait',
            'wrap' => 'canvas',
            'headline' => 'Portret',
            'intro' => '
                <p>Mijn favoriete onderwerp. Ik blijf gezichten fascinerend vinden.
                Dit is nog moeilijker dan een figuur omdat de gelijkenis — of je het nu wil of niet — altijd een rol speelt.
                Hoe langer ik portretten schilder hoe meer ik besef dat compositie en sfeer essentieel zijn voor een geslaagd portret.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function landscape()
    {
        $data = [
            'title' => 'Landscapes by Daanjels',
            'page' => 'landscape',
            'wrap' => 'canvas',
            'headline' => 'Landschap',
            'intro' => '
                <p>Het is boeiend om eens een landschap op een groter formaat uit te werken.
                Hier heb ik bewust gekozen om een landschap op portret ori&euml;ntatie te maken.
                Door het opstaande formaat vind je er gemakkelijk een plek voor in huis.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function bird()
    {
        $data = [
            'title' => 'Birds painted by Daanjels',
            'page' => 'bird',
            'wrap' => 'canvas',
            'headline' => 'Vogels',
            'intro' => '
                <p>Een reeks schilderijtjes van vogels die af en toe in de tuin passeren.
                Interessante oefeningen waar ik voor het eerst de verf dikker begon te gebruiken.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function figure()
    {
        $data = [
            'title' => 'Figure paintings by Daanjels',
            'page' => 'figure',
            'wrap' => 'canvas',
            'headline' => 'Levend model',
            'intro' => '
                <p>Modelsessies buiten de academie zijn een welkome afwisseling.
                Na wat snelschetsen om op te warmen, volgen poses van een kwartier tot een half uur.
                In zo\'n korte tijd moet je aandachtig te werk gaan.
                Enkel dankzij uiterste concentratie kun je de essentie van een pose vatten.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function figurestudy()
    {
        $data = [
            'title' => 'Studies by Daanjels',
            'page' => 'figurestudy',
            'wrap' => 'canvas',
            'headline' => 'Studie naar levend model',
            'intro' => '
                <p>Werk uit de schilderlessen bij Philippe De Smedt.
                Naar levend model schilderen is de beste oefening.
                Hier komt alles aan bod terwijl het onverbiddelijk is:
                anderen zien meteen waar verhoudingen niet snor zitten.
                Na jarenlange praktijk begint dat stilaan te verbeteren.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function pleinair()
    {
        $data = [
            'title' => 'Outdoor painting by Daanjels',
            'page' => 'pleinair',
            'wrap' => 'carton',
            'headline' => 'Plein air schilderen',
            'intro' => '
                <p>Af en toe trommel ik vrienden op om samen in open lucht te schilderen.
                Dat zijn aangename momenten waarbij ieder naar eigen kunnen tekent of schildert.
                Daarbij staat het oefenen en het ongedwongen schilderplezier centraal.
                Net daarom levert het regelmatig aardige schilderijen op. </p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
    public function summer()
    {
        $data = [
            'title' => 'Daanjels paints during the summer season',
            'page' => 'summer',
            'wrap' => 'carton',
            'headline' => 'Zomerschilderen',
            'intro' => '
                <p>Al enkele jaren neem ik deel aan de <em>Zomerschilderdagen </em>in de ruime omgeving van Heist-op-den-Berg.
                De Dienst voor Toerisme voorziet in schilderachtige locaties waar liefhebbers elke dinsdag tijdens de zomervakantie komen schilderen of tekenen.
                Het is een beetje vakantie in eigen land.</p>
                ',
        ];
        $this->view('portfolios/collection', $data);
    }
}