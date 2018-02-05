<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Mr. Yoso',
            'email' => 'jeff.lapuz09@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 1,
            'gender' => 1,
            'isActive' => 1,
            'description' => "<p>Hi! Ito po pala ako, Mr. Yoso (Misteryoso) Hindi Mr. Yasuo, dahil hindi ako gumagamit ng Yasuo sa LOL. Hindi rin ako Mr. Yosi.&nbsp;</p>
            <p>&nbsp;</p>
            <p>Pero sino nga ba si Mr. Yoso, bilang isang tao?</p>
            <p>&nbsp;</p>
            <p>Napakacute, napakapogi, napakasinungaling haha! Pero hindi naman sa lahat ng pagkakataon masasabi kong sinungaling ako. Hahaha! Syempre para sakin pogi ako at cute. Hahaha! Ewan ko na lang sa iba.&nbsp;</p>
            <p>&nbsp;</p>
            <p>Ako po ay isang estudyante pa lamang na nagaaral sa Polytechnic University of the Philippines kumukuha ng Information Technology. 19 years old, pero mag20 ngayong setyembre. Haha! Weird parang nagiintro lang ako sa klase lol.</p>
            <p>&nbsp;</p>
            <p>Mabait ba ako? Ewan! Siguro oo madami naman nagsasabi e. Huwag lang ako inisin. Baka kung ano pa magawa ko sa'yo. Weird din ako. Haha! Hindi ko kayo tinatakot or baka sabihin niyo creepy ako. Pero RT dati ng mainlove ako may pagkastalker ako nakasunod kung saan siya pumupunta at tinitignan lagi kasama niya. Pero dati yun hindi ngayon.&nbsp; Mahilig sa mythology lalo na sa mga Greek Gods basta iba't-iba pero ngayon trip ko celtic myth. Masiyahin din naman kaso.&nbsp;</p>
            <p>&nbsp;</p>
            <p>Ako po ay biktima ng Depression. Hindi ko alam e. Minsan inaatake ako nun. Sa mga nakakakilala sa'kin siguro naman napansin nila. Siguro dahil sa kalagayan ng pamilya ko ngayon. Nadadala kasi ako kapag nakikita kong umiiyak nanay ko.&nbsp; Kasalukuyan kasi kami lubog sa utang. Hindi naman sa nagmamakaawa ako lol. Sinasabi ko lang. Kaya para sa mga pamilya diyan na masyadong masagana. Huwag niyong hayaan na wala kayong ipon baka mangyari kayo samin na bankrupt.</p>
            <p>&nbsp;</p>
            <p>Paano po ba ako nakapasok sa Deep Web Enigma?</p>
            <p>&nbsp;</p>
            <p>Since 2nd year college nacurious na talaga ako sa Deep Web. Mga kwento kasi sa social media puro panakot lol. Pero dahil sa pagkacurious ko pinasok ko naman at siguro hanggang ngayon wala pa naman nangyayari sa'kin.</p>
            <p>&nbsp;</p>
            <p>Naging admin na rin ako sa ibang deep web groups. Kung may nakita kayo siguro na mahilig magtadtad ng mga post tapos puro pdf. Siguro makikilala niyo ako. Pero dati pa yun mga 2015 ata.</p>
            <p>&nbsp;</p>
            <p>So yun ngayong 2017 lang ako nagbalik kasi naging busy naging inactive. May mga kakilala na rin ako na admin kagaya nila Geek, beast, leghorn kilala ko sila pero ako hindi nila kilala, pero ewan ko lang.</p>
            <p>&nbsp;</p>
            <p>Bago ako makapasok ng Deep Web Enigma nasa Deep Web Readers PH. Ako rin po si Vanta Black na dati ang tagline ko Mabilis pumasok, pero tagal labasan HAHA Dahil po naipit ako sa pila sa supermarket haha! Duon ko rin nakilala si Mad Alice na mahilig mambasag sa kung ano man ang trip ko sa buhay ko. lol Lagi ko rin siya naiisip lol ewan ko ba hahahaha! Maisingit lang.</p>
            <p>&nbsp;</p>
            <p>So yun Mr. Yoso. Pogi pero hindi fuckboy. Paglilingkuran ko kayo hanggang sa makakaya ko.&nbsp;</p>
            <p>&nbsp;</p>",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
