<?php

use App\Models\ModelsAutomobile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModelsAutomobileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models_automobile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brands_automobile_id');
            $table->string('name_slug');
            $table->string('name');
            $table->timestamps();

            $table->foreign('brands_automobile_id')->references('id')->on('brands_automobile');
        });
        $arr = [
				["24 HP","12 HP","15 HP","40-60 HP","Grand Prix","20-30 HP","G1","G2","RL","RM","6C","P1","P2","Tipo A","8C","Tipo B","Bimotore","12C","1900","Matta","Giulietta","2000","Dauphine","2600","Giulia Saloon","Giulia TZ","Giulia Sprint","Giulia Sprint Speciale","Gran Sport Quattroruote","GTA","Giulia Spider","33 Stradale","Berlina","Montreal","Alfasud","Alfetta saloon","Alfetta GT/GTV","Alfasud Sprint","Nuova Giulietta","Alfa 6","33","Arna","90","75","164","SZ/RZ","155","145","146","GTV/Spider","156","166"],
				["770"],
				["Standard Sports","First Series","International","Le Mans","12/50 Standard","Mk II","Ulster","Speed","15/98","DB1","DB2","DB2/4","DB Mark III","DB4","DB4 GT Zagato","DB5","Short Chassis Volante","DB6","DBS","V8","V8 Vantage","V8 Zagato","Virage","Vantage","DB7","Lagonda"],
				["Type R","Type S","Type T","Type P","Front UW","920","60","80","50","100","100 Coupe S","200","90","Coupe GT","Sport quattro","V8","Coupe","A3","A4","A6","A8","TT","S2","S4","S8","S6","RS2 Avant","Quattro"],
				["7","7 hp","Seven","Mini","Metro","10","10 hp","8","A30","A35","A35 Countryman","Metropolitan","A40 Farina MkI","A40 Farina MkII","1100","1300","Allegro","15 hp","12","14","18","16","16 hp","A40 Devon/Dorset","A70 Hampshire","A70 Hereford","A40 Somerset","A40/A50/A55 Cambridge","A90/A95/A105 Westminster","A105 Westminster","A55 Cambridge","A99 Westminster","A60 Cambridge","A110 Westminster","1800/2200 (ADO17)","3-Litre","Maxi","1800/2200 (ADO71)","Ambassador","Maestro","Montego","Twenty","Twenty Eight","A110/A125 Sheerline","A120 Princess","A135 Princess","Princess IV","A90 Atlantic Convertible","A90 Atlantic Saloon","Austin-Healey 100","Austin-Healey Sprite","Austin-Healey 3000","Sprite","Lancer","Freeway","Kimberley/Tasman"],
				["3-litre","4½-litre","6½-litre","6½-litre Speed Six","8-litre","4-litre","3½-litre","4¼-litre","Mark V","Mark VI","R Type","S1","S2","S3","T1","T2","Corniche","Camargue","Continental","Continental Turbo","Mulsanne","Eight","Turbo R"," Brooklands","Turbo S","Azure","Arnage"],
				["Type 13","Type 18","Type 23/Brescia Tourer ","Type 30/38/40/43/44/49","Type 41 Royale","Type 46/50/50T","Type 55","Type 57","Type 101","Type 252","EB110"],
				["3/15 sedan","3/20 PS","303 sedan","309 sedan","315 sedan","315/1 roadster","319 sedan","319/1 roadster","329 convertible","326","327","320","321","335","328 Roadster","340","501","502","Isetta","600","503","507","700","1500","1600","1800","2000","3200 CS","2000C","2000CS","1502","1602","1802","E9 New Six","E3 New Six","Series 3","Series 5","Series 6","Series 7","Series 8","Z1","Z3"],
				["Model B","Model C","Model F&G","Model 10","Model 14","Special","Roadmaster","Century","Super","Skylark","Invicta","Electra","LeSabre","Wildcat","Riviera","Estate","Centurion","Apollo","Skyhawk","Somerset","Reatta","Park Avenue"],
				["Seville","Cimarron","Coupe de Ville","Sedan de Ville","Fleetwood","Eldorado","Calais","Brougham","Allante","de Ville"],
				["150","210","3100","Bel-Air","Camaro","Caprice","Chevelle","Corvair","Corvette","Impala","Master","Monte Carlo","Silverado","SSR","Apache","El Camino","Fleetmaster"],
				["300","Imperial","New Yorker","Town & Country","Windsor","Sunbeam","Sigma"],
				["2CV","Ami 6","Ami 8","Bijou","DS/ID","Dyane","H Van","Acadiane","Ami Super","Axel","C25","C35","CX","FAF","Traction Avant","GS","GSA","LN","M35","SM","Visa","AX","BX","C15","XM","ZX"],
				["1300","1410 Sport"],
				["Bee","Charade","Charmant","Campagno","Mira/Cuore","Fellow","Feroza"],
				["510","Bluebird","Fairlady","280ZX","Cherry","240Z","260Z","280Z","Violet 710"],
				["DMC-12"],
				["330","400","440","600","880","Aspen","Challenger","Charger","Coronet","Custom","Daytona","Dart","Lancer","Meadowbrook","Monaco","Viper"],
				["250 Europa","250 Europa GT","410 Superamerica","275","500 Superfast","365 Daytona","Dino","208/308","348","F355","Mondial","Berlinetta Boxer","Testarossa","250 GTO","F40","F50"],
				["522","1500","1100","500 Topolino","2800","500","1400","8V","600","1200","1800","2300","1300","850","850 Coupe","124","Dino","125","128","128 Coupe","130","127","124 Coupe","X19","126","132","133","131","Ritmo","Campagnola","Argenta","Uno","Tipo","Coupe","615"],
				["Anglia","Bronco","Capri","Cortina","Crestline","Escort","Fairlane","Falcon","Fiesta","GT","GT40","Model A","Model T","Model K","Mustang","Probe","Puma","RS200","RS500","Sierra","Sierra Coworth","Taunus","Thunderbird","Torino","Model B","Pinto","Scorpio","Maverick","Corsair","Consul"],

				["M-20 Pobeda","12 ZIM","Volga","24","69"],
				["Cabover truck","Pick-up"],
				["Accord","Civic","Legend","NSX","S800","S500","S2000","N360","1300","CR-X","Integra","Prelude","Z"],
				["H1","H2"],
				["Coupe","Scoupe","Pony"],
				["Bellett","117 Coupe","Gemini","Piazza","Trooper"],
				["Mark IV","Mark V","Mark VII","Mark VIII","Mark IX","Mark X","420G","XJ6","XJ12","XJ8","XK120","XK140","XK150","E-Type","XJ-S","XJ220","S-Type"],
				["Willys","CJ","Forward Control","Fleetwan","Cherokee","Comanche","Wrangler","Grand Cherokee"],
				["Brisa","Concord","Pride"],
				["1200/1300","VAZ-2101","1500","VAZ-2103","Samara","Riva"],

				["350 GT","400 GT","Miura","Espada","Islero","Jarama","Urraco","Countach","Silhouette","Jalpa","LM002","Diablo"],
				["Appia","Aprilia","Ardea","Artena","Augusta","Aurelia","Beta Coupe","Beta","Montecarlo","Delta","Gamma","Hpe","Prisma","Stratos","Thema","Trevi","Flaminia","Fulvia","Flavia"],
				["Series I","Series II","Series IIA","Series III","Range Rover","Defender"],
				["Zephyr","Cosmopolitan","Capri","Premiere","Versailles","Continental"],
				["Elan","Europa","Elite","Eclat","Esprit","Excel","Elise"],
				["A6","3500 GT","5000 GT","Mistral","Quattroporte","Sebring","Mexico","Ghibli","Indy","Khamsin","Bora","Merak","Kyalami","Biturbo","Karif","Shamal"],
				["Djet","530","Bagheera","Murena","Rancho"],
				["Cosmo","323","121","929","626","MX-3","MX-6","MX-5 Miata","RX-2"],
				["Zeppelin"],
				["Model K","Mannheim","130","150","170","W136","770","500K","540K","260D/W138","W191","180/W120","190 Sl/W121","W187","W105","W180","W186/300","W189","300 SLR","300 Sl/W198","W110","W111","W108","W114/W115","600/W100","W113","W123","G-Class","W116","Sl/R107/C107","W126","190","C126 SEC"],

				["T-series","MGA","Midget","MGB","MGB GT","RV8","Magnette"],
				["Mark I","Mark II","Mark III","Mark IV","Mark V","Mark VI"],
				["500","3000GT","Celeste","Colt","Cordia","Eclipse","Galant","Galant FTO","Galant GTO","Lancer","Lancer Evolution","Minica","Pajero"],
				["F1"],
				["4/4","+4","+4+","+8"],
				["400-420","402","410","408","412","2140","2141 Aleko","404 Sport"],
				["Patrol","Skyline","Skyline GT-R","Micra","Silvia","180SX","200SX","240SX","300ZX","Pathfinder","Sunny","NX","Terrano"],
				["Prinz","Sport Prinz","1000","Spider","Ro 80","1200"],
				["Series 60","Series 70","98","88","Cutlass","F-85","Starfire","Jetstar I","Vista Cruiser","Toronado","Cutlass Supreme","4-4-2","Custom Cruiser","Omega","Firenza","Ciera","Calais","Touring Sedan"],
				["Corsa","Tigra","Olympia","Kadett","Astra","Ascona","Manta","Vectra","Calibra","Rekord","Commodore","Senator","Monza","Omega","Kapitän","GT","Fronter","Monterey","Blitz","Admiral","Super 6","P4","Regent"],

				["5CV","104","106","201","202","203","204","205","301","302","304","305","306","309","401","402","403","404","405","504","505","601","604","605"],
				["2+2","Sunbird","Astre","Bonneville","Catalina","Chieftain","Custom S","Fiero","Firebird","Grand Am","Grand Prix","GTO","LeMans","Star Chief","Streamliner","Trans Am"],
				["180","200","300","Caribbean","Clipper","Eight","Hawk","120","Patrician","Super Eight"],
				["356","911","912","914","924","928","930","959","968","964","993","911/964 Turbo","911/964 Carrera","911/964 Carrera RS"],
				["Fuego","Rodeo","4CV","Caravelle","Colorale","Dauphine","Juvaquatre","Fregate","Domaine","Manoir","Torino","Primaquatre","Vivasport","4","4 Fourgonnete","5","5 Turbo","5 Alpine","5 Gordini","5 Alpine Turbo","6","7","R8","R8 Gordini","9","9 Turbo","10","11","12","12 Gordini","R12 Alpine","14","15/17","17 Gordini","16","18","18 Turbo","19","20/30","21","25","Clio","Clio Williams"],
				["Phantom I","Phantom II","Phantom III","Phantom IV","Phantom V","Phantom VI","25/30","Wraith","Silver Wraith","Silver Dawn","Silver Cloud","Silver Shadow","Corniche","Silver Spirit","Silver Spur","Camargue"],
				["10","14","16","P4","200","600","800","P6","P5","P3","P2","SD1"],
				["92","93","GT750","94","95","96","Sonett II","99","Sonett III","900","600","90","9000"],
				["124","124 Sport","127","128","131","132","133","600","800","850","1200 Sport","1400","1430","1430 Sport","1500","Fura","Malaga/Gredos","Ibiza","Ibiza Cupra","Ibiza Cupra R","Panda","Marbella","Ritmo","Ronda"],
				["5","6","8","Aronde","Ariane","Vedette","1000","1000 Coupe","1100","1300","1500","1301","1501","1200S","1609","1307"],

				["360","450","100","1500","Leone","Alcyone SVX","XT","BRAT/284","FF-1 Star","Rex","Justy","Impreza","Impreza WRX","Impreza WRX STI","Legacy","Libert","Sambar","R-2","Libero"],
				["Alto","Cappuccino","Cara/PG6SA","Carry","Cervo","Vitara","Fronte","Jimny","Swift","Hatch","Samurai","Might Boy"],
				["Laurin & Klement","633","637","Rapid","Favorit","Superb","1101 Tudor","1102","VOS","1200","440","Felicia","Octavia","1202","Octavia Combi","1000 MB","1203","100/110","110R Coupe","105","120","125","130","135","136","Garde"],
				["1100","Avenger","Murena GT","Tagora"],
				["1102"],
				["1000","2000GT","AA","AB","AC","AE","BJ","Land Cruiser","Carina","Celica","Chaser","Tercel","Corona","Corona Coupe","Corona Mark II","Cresta","MR2","Corolla","Hilux","Publica","Camry","Sera","Soarer","Sports 800","Corolla Levin","Sprinter Trueno","Starlet","Supra"],
				["600","601","P50","1.1"],
				["Super 7","Super 8","Super 9","Gloria","Dolomite","Vitesse","1800 Saloon","1800 Roadster","2000 Saloon","2000 Roadster","Mayflower","TR1","TR2","TR3","Italia","TR4","TR5","Dové GTR4","TR6","TR7","TR8","Spitfire","GT6","Herald","1300","1500","Stag","Toledo","2000","2.5 PI","2500 TC & S","Acclaim"],
				["Grantura","Griffith 200","Griffith 400","Tuscan","Vixen","M Series","Tasmin/280i","350i","400/450 SE","390 SE","420 SEAC","450 SEAC","S Series","Griffith","Chimaera"],
				["469","31514","452"],

				["181","Apollo","Beetle","Brasilia","Corrado","Derby","Golf Mk1","Golf Mk2","Golf Mk3","Iltis","Jetta A1","Jetta A2","K70","Karmann Ghia","Passat B1","Passat B2","Passat B3","Polo Mk1","Polo Mk2","Scirocco I","Scirocco II","SP2","T1","T2","T3","411","412","Hebmüller Cabriolet","Caddy"],
				["ÖV4/PV4","PV650","TR670","PV36 Carioca","PV51 Series","PV800 Series","PV444/544","PV60","Duett","P1900","Amazon","P1800","140 Series","164","240","260","66","340","360","262C","740","760","480","780 Coupe","440","460","940","960","850"],
				["311","313 Roadster","312","353","1.3"],
				["AR51","AR55","1400 BJ","1100E","750","850","1300","1500","101","128","Yugo 45","Yugo 55","Yugo 60","Yugo 65","Yugo Cabrio","Florida"],
				["Ostalo"]
        ];

        for ($i = 0; $i < count($arr); $i++){
          for ($j = 0; $j < count($arr[$i]); $j++){
          		$z = $i + 1;
               // $lol[] = $arr[$i][$j].'model'.$z;
          			$brand = new ModelsAutomobile;
          			$brand->brands_automobile_id = $z;
        			$brand->name_slug = Str::slug($arr[$i][$j]);
          			$brand->name = $arr[$i][$j];
          			$brand->save();
            }
         }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models_automobile');
    }
}
