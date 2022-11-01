<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Market\{Section, Category};
use Faker\Factory as Faker;


class Market_Sections_and_Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Section::create(['id' => 1, 'name' => 'Supermercato']);
        Section::create(['id' => 2, 'name' => 'Abbigliamento']);
        Section::create(['id' => 3, 'name' => 'Auto e Moto - Parti e Accessori']);
        Section::create(['id' => 4, 'name' => 'Bellezza']);

        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Frutta', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Verdura e insalate', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Latticini, salumi e formaggi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Carne e pesce', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Surgelati e gelati', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Gastronomia', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Dispensa', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Bevande', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Cura della persona', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Casa, ufficio e animali', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Infanzia', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 1, 'name' => 'Offerte', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Abbigliamento specifico', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Bambina', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Bambino', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Abbigliamento sportivo specifico', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Uomo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Donna', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 2, 'name' => 'Prima infanzia', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Moto & Accessori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per auto', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Parti di ricambio', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Cura auto e moto', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Oli e liquidi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Attrezzi per veicoli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Verniciatura', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Cerchioni e Pneuatici', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Articoli regalo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Elettronica per veicoli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per caravan', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 3, 'name' => 'Accessori per viaggio', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Trucco', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Manicure e Pedicure', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Cura dei capelli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Accessori e strumenti di bellezza', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Cura della pelle', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Attrezzature per saloni e SPA', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 0, 'section_id' => 4, 'name' => 'Fragranze e profumi', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta fresca esotica', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta bio', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Macedonie di frutta', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutta secca', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Agrumi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Frutti di bosco', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 1, 'section_id' => 1, 'name' => 'Mele', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Insalate in busta', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Pomodori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Erbe fresche e Sapori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Verdura e Insalate bio', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 2, 'section_id' => 1, 'name' => 'Aglio e Cipolla', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Affettati e Salumi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Formaggi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Latte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Bevande vegetali', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Uova', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Burro e margarina', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 3, 'section_id' => 1, 'name' => 'Yogurt e Dessert refrigerati', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 4, 'section_id' => 1, 'name' => 'Carne', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 4, 'section_id' => 1, 'name' => 'Pesce', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Verdura, Minestroni e Zuppe', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Pizza', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Pesce', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Gelati e Dessert', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 5, 'section_id' => 1, 'name' => 'Piatti pronti', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Primi piatti pronti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Zuppe e minestre pronte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Secondi piatti pronti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Contorni pronti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Piatti vegetariani pronti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Salsa e Sughi pronti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Bowl e Insalate pronte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Tramezzini e Piadine pronte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Merende pronte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 6, 'section_id' => 1, 'name' => 'Basi e Sfoglie pronte', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Pasta, Riso e Legumi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cibi in scatola e Conserve', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Sughi e Passate', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Oli, Spezie e Condimenti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Pane e Sostituti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Farine e Preparati da cucina', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Biscotti e Prodotti da forno', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cereali e Muesli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Confetture', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Snack salati', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => 'Cioccolata, Caramelle e Gomme', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 7, 'section_id' => 1, 'name' => "Alimenti per l'infanzia", 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Acqua', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Latte', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Bevande vegetali', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Succhi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Analcolici', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Caffè', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Tè, Tisane e Infusi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Birra', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Vino', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 8, 'section_id' => 1, 'name' => 'Superalcolici', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Bagno e corpo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Cura dei capelli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Cura della pelle', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Igiene orale', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Deodoranti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Igiene intima e Assorbenti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Rasatura e Depilazione', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Makeup, Smalti e Profumi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Infanzia', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 9, 'section_id' => 1, 'name' => 'Integratori e Medicazione', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Detergenti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Bucato', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Stoviglie', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Carta, Pellicole e Sacchetti', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Casalinghi', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Animali', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Giocattoli', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 10, 'section_id' => 1, 'name' => 'Ufficio, Elettronica e Cancelleria', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Pannolini', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Salviettine e Accessori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Igiene e Cura Corpo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => "Alimenti per l'infanzia", 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 11, 'section_id' => 1, 'name' => 'Latte artificiale per neonati', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Costumi e Accessori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Abbigliamento da lavoro e Divise', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 13, 'section_id' => 1, 'name' => 'Merchandising Film e TV', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Abbigliamento sportivo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Felpe', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 14, 'section_id' => 1, 'name' => 'Mare e Piscina', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Abbigliamento sportivo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Accessori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 15, 'section_id' => 1, 'name' => 'Pantaloni', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Korfball', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Calcio', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Cricket', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 16, 'section_id' => 1, 'name' => 'Corsa', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'Accessori', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'T-Shirt, Polo e Canicie', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 17, 'section_id' => 1, 'name' => 'Intimo', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'Abbigliamento da notte, Lingerie e Intimo', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'T-Shirt, Top e Bluse', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 18, 'section_id' => 1, 'name' => 'Abbigliamento sportivo', 'description' => $faker->paragraph(1, true)]);

        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Bambina 0-24', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Bambino 0-24', 'description' => $faker->paragraph(1, true)]);
        Category::create(['parent_id' => 19, 'section_id' => 1, 'name' => 'Accessori per bambina', 'description' => $faker->paragraph(1, true)]);
    }
}
