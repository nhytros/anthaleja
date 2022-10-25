<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Market\{Section, Category};

class Market_Sections_and_Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create(['id' => 1, 'name' => 'Supermercato']);
        Section::create(['id' => 2, 'name' => 'Abbigliamento']);
        Section::create(['id' => 3, 'name' => 'Auto e Moto - Parti e Accessori']);
        Section::create(['id' => 4, 'name' => 'Bellezza']);

        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Frutta']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Verdura e insalate']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Latticini, salumi e formaggi']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Carne e pesce']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Surgelati e gelati']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Gastronomia']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Dispensa']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Bevande']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Cura della persona']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Casa, ufficio e animali']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Infanzia']);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Offerte']);

        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Abbigliamento specifico']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Bambina']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Bambino']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Abbigliamento sportivo specifico']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Uomo']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Donna']);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Prima infanzia']);

        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Moto & Accessori']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per auto']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Parti di ricambio']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Cura auto e moto']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Oli e liquidi']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Attrezzi per veicoli']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Verniciatura']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Cerchioni e Pneuatici']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Articoli regalo']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Elettronica per veicoli']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per caravan']);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per viaggio']);

        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Trucco']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Manicure e Pedicure']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Cura dei capelli']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Accessori e strumenti di bellezza']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Cura della pelle']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Attrezzature per saloni e SPA']);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Fragranze e profumi']);

        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta fresca esotica']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta bio']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Macedonie di frutta']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta secca']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Agrumi']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutti di bosco']);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Mele']);

        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Insalate in busta']);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Pomodori']);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Erbe fresche e Sapori']);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Verdura e Insalate bio']);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Aglio e Cipolla']);

        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Affettati e Salumi']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Formaggi']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Latte']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Bevande vegetali']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Uova']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Burro e margarina']);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Yogurt e Dessert refrigerati']);

        Category::create(['parent_id' => 4, 'section_id' => 1, 'name' => 'Carne']);
        Category::create(['parent_id' => 4, 'section_id' => 1, 'name' => 'Pesce']);

        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Verdura, Minestroni e Zuppe']);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Pizza']);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Pesce']);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Gelati e Dessert']);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Piatti pronti']);

        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Primi piatti pronti']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Zuppe e minestre pronte']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Secondi piatti pronti']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Contorni pronti']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Piatti vegetariani pronti']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Salsa e Sughi pronti']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Bowl e Insalate pronte']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Tramezzini e Piadine pronte']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Merende pronte']);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Basi e Sfoglie pronte']);

        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Pasta, Riso e Legumi']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cibi in scatola e Conserve']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Sughi e Passate']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Oli, Spezie e Condimenti']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Pane e Sostituti']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Farine e Preparati da cucina']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Biscotti e Prodotti da forno']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cereali e Muesli']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Confetture']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Snack salati']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cioccolata, Caramelle e Gomme']);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => "Alimenti per l'infanzia"]);

        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Acqua']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Latte']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Bevande vegetali']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Succhi']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Analcolici']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Caffè']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Tè, Tisane e Infusi']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Birra']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Vino']);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Superalcolici']);

        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Bagno e corpo']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Cura dei capelli']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Cura della pelle']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Igiene orale']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Deodoranti']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Igiene intima e Assorbenti']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Rasatura e Depilazione']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Makeup, Smalti e Profumi']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Infanzia']);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Integratori e Medicazione']);

        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Detergenti']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Bucato']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Stoviglie']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Carta, Pellicole e Sacchetti']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Casalinghi']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Animali']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Giocattoli']);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Ufficio, Elettronica e Cancelleria']);

        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Pannolini']);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Salviettine e Accessori']);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Igiene e Cura Corpo']);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => "Alimenti per l'infanzia"]);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Latte artificiale per neonati']);

        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Costumi e Accessori']);
        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Abbigliamento da lavoro e Divise']);
        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Merchandising Film e TV']);

        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Abbigliamento sportivo']);
        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Felpe']);
        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Mare e Piscina']);

        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Abbigliamento sportivo']);
        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Accessori']);
        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Pantaloni']);

        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Korfball']);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Calcio']);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Cricket']);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Corsa']);

        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'Accessori']);
        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'T-Shirt, Polo e Canicie']);
        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'Intimo']);

        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'Abbigliamento da notte, Lingerie e Intimo']);
        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'T-Shirt, Top e Bluse']);
        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'Abbigliamento sportivo']);

        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Bambina 0-24']);
        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Bambino 0-24']);
        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Accessori per bambina']);




    }
}
