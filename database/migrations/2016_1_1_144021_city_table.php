<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\City;
class CityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->string('name');
            $table->timestamps();
        });

        $arr = ['Ada'=>'Ada','Aleksandrovac'=>'Aleksandrovac','Aleksinac'=>'Aleksinac','Alibunar'=>'Alibunar','Apatin'=>'Apatin','Aranđelovac'=>'Aranđelovac','Arilje'=>'Arilje','Azanja'=>'Azanja','Babušnica'=>'Babušnica','Bač'=>'Bač','Bačka Palanka'=>'Bačka Palanka','Bačka Topola'=>'Bačka Topola','Bački Petrovac'=>'Bački Petrovac','Bačko Petrovo Selo'=>'Bačko Petrovo Selo','Bajina Bašta'=>'Bajina Bašta','Banatski Karlovac'=>'Banatski Karlovac','Banatsko Novo Selo'=>'Banatsko Novo Selo','Banja Koviljača'=>'Banja Koviljača','Barajevo'=>'Barajevo','Batajnica'=>'Batajnica','Batočina'=>'Batočina','Bečej'=>'Bečej','Bela Crkva'=>'Bela Crkva','Bela Palanka'=>'Bela Palanka','Beočin'=>'Beočin','Beograd'=>'Beograd','Beograd | Batajnica'=>'Beograd | Batajnica','Beograd | Čukarica'=>'Beograd | Čukarica','Beograd | Grocka'=>'Beograd | Grocka','Beograd | Novi Bg.'=>'Beograd | Novi Bg.','Beograd | Palilula'=>'Beograd | Palilula','Beograd | Rakovica'=>'Beograd | Rakovica','Beograd | Savski venac'=>'Beograd | Savski venac','Beograd | Stari grad'=>'Beograd | Stari grad','Beograd | Surčin'=>'Beograd | Surčin','Beograd | Voždovac'=>'Beograd | Voždovac','Beograd | Vračar'=>'Beograd | Vračar','Beograd | Zemun'=>'Beograd | Zemun','Beograd | Zvezdara'=>'Beograd | Zvezdara','Beška'=>'Beška','Blace'=>'Blace','Bogatić'=>'Bogatić','Bojnik'=>'Bojnik','Boljevac'=>'Boljevac','Bor'=>'Bor','Borča'=>'Borča','Bosilegrad'=>'Bosilegrad','Brus'=>'Brus','Bujanovac'=>'Bujanovac','Crvenka'=>'Crvenka','Čačak'=>'Čačak','Čelarevo'=>'Čelarevo','Čoka'=>'Čoka','Čurug'=>'Čurug','Ćićevac'=>'Ćićevac','Ćuprija'=>'Ćuprija','Despotovac'=>'Despotovac','Dimitrovgrad'=>'Dimitrovgrad','Dolovo (kod Pančeva)'=>'Dolovo (kod Pančeva)','Doljevac'=>'Doljevac','Feketić'=>'Feketić','Futog'=>'Futog','Gornji Milanovac'=>'Gornji Milanovac','Horgoš'=>'Horgoš','Inđija'=>'Inđija','Inostranstvo'=>'Inostranstvo','Irig'=>'Irig','Ivanjica'=>'Ivanjica','Jagodina'=>'Jagodina','Kačarevo'=>'Kačarevo','Kać'=>'Kać','Kanjiža'=>'Kanjiža','Kikinda'=>'Kikinda','Kladovo'=>'Kladovo','Knić'=>'Knić','Knjaževac'=>'Knjaževac','Koceljeva'=>'Koceljeva','Kopaonik'=>'Kopaonik','Kosjerić'=>'Kosjerić','Kosovska Mitrovica'=>'Kosovska Mitrovica','Kostolac'=>'Kostolac','Kovačica'=>'Kovačica','Kovilj'=>'Kovilj','Kovin'=>'Kovin','Kragujevac'=>'Kragujevac','Kraljevo'=>'Kraljevo','Krupanj'=>'Krupanj','Kruševac'=>'Kruševac','Kučevo'=>'Kučevo','Kula'=>'Kula','Kuršumlija'=>'Kuršumlija','Kusadak'=>'Kusadak','Lajkovac'=>'Lajkovac','Lapovo'=>'Lapovo','Lazarevac'=>'Lazarevac','Lebane'=>'Lebane','Leposavić'=>'Leposavić','Leskovac'=>'Leskovac','Loznica'=>'Loznica','Lučani'=>'Lučani','Ljig'=>'Ljig','Ljubovija'=>'Ljubovija','Majdanpek'=>'Majdanpek','Mali Iđoš'=>'Mali Iđoš','Mali Zvornik'=>'Mali Zvornik','Medveđa'=>'Medveđa','Melenci'=>'Melenci','Merošina'=>'Merošina','Mladenovac'=>'Mladenovac','Mol'=>'Mol','Negotin'=>'Negotin','Niš'=>'Niš','Nova Pazova'=>'Nova Pazova','Nova Varoš'=>'Nova Varoš','Novi Banovci'=>'Novi Banovci','Novi Bečej'=>'Novi Bečej','Novi Kneževac'=>'Novi Kneževac','Novi Pazar'=>'Novi Pazar','Novi Sad'=>'Novi Sad','Obrenovac'=>'Obrenovac','Odžaci'=>'Odžaci','Opovo'=>'Opovo','Palić'=>'Palić','Pančevo'=>'Pančevo','Paraćin'=>'Paraćin','Petrovac na Mlavi'=>'Petrovac na Mlavi','Petrovaradin'=>'Petrovaradin','Pirot'=>'Pirot','Plandište'=>'Plandište','Pojate'=>'Pojate','Požarevac'=>'Požarevac','Požega'=>'Požega','Preševo'=>'Preševo','Priboj'=>'Priboj','Prijepolje'=>'Prijepolje','Prokuplje'=>'Prokuplje','Pukovac'=>'Pukovac','Rača Kragujevačka'=>'Rača Kragujevačka','Raška'=>'Raška','Ražanj'=>'Ražanj','Ruma'=>'Ruma','Rumenka'=>'Rumenka','Ruski Krstur'=>'Ruski Krstur','Senta'=>'Senta','Sevojno'=>'Sevojno','Sivac'=>'Sivac','Sjenica'=>'Sjenica','Smederevo'=>'Smederevo','Smederevska Palanka'=>'Smederevska Palanka','Sokobanja'=>'Sokobanja','Sombor'=>'Sombor','Sopot'=>'Sopot','Srbobran'=>'Srbobran','Sremska Kamenica'=>'Sremska Kamenica','Sremska Mitrovica'=>'Sremska Mitrovica','Sremski Karlovci'=>'Sremski Karlovci','Stara Pazova'=>'Stara Pazova','Starčevo'=>'Starčevo','Stari Banovci'=>'Stari Banovci','Subotica'=>'Subotica','Surdulica'=>'Surdulica','Svilajnac'=>'Svilajnac','Svrljig'=>'Svrljig','Šabac'=>'Šabac','Šid'=>'Šid','Štrpce'=>'Štrpce','Temerin'=>'Temerin','Titel'=>'Titel','Topola'=>'Topola','Trstenik'=>'Trstenik','Tutin'=>'Tutin','Ub'=>'Ub','Užice'=>'Užice','Valjevo'=>'Valjevo','Varvarin'=>'Varvarin','Velika Plana'=>'Velika Plana','Veliko Gradište'=>'Veliko Gradište','Veternik'=>'Veternik','Vinča'=>'Vinča','Vladičin Han'=>'Vladičin Han','Vladimirci'=>'Vladimirci','Vlasotince'=>'Vlasotince','Vojka'=>'Vojka','Vranje'=>'Vranje','Vranjska Banja'=>'Vranjska Banja','Vrbas'=>'Vrbas','Vrnjačka Banja'=>'Vrnjačka Banja','Vršac'=>'Vršac','Zaječar'=>'Zaječar','Zlatibor'=>'Zlatibor','Zrenjanin'=>'Zrenjanin','Zubin Potok'=>'Zubin Potok','Zvečan'=>'Zvečan','Žabalj'=>'Žabalj','Žagubica'=>'Žagubica','Žitorađa'=>'Žitorađa'];
		// foreach ($arr as $ke => $val){
		// 	$city[] = $val;
		// }

        foreach ($arr as $key => $value) {
        	$city = new City;
        	$city->name = $value;
        	$city->country_id = 1;
        	$city->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
}
