<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['id' => 1, 'name' => 'madieye', 'email' => 'admin@colopilot.test', 'password' => '$2y$12$ltfxI449DBkVesCPNXWXuuo6kQ6QTBfW5eApM4VVy2eWO2BDvuh9u', 'role' => 'administrateur', 'group_id' => null, 'phone_number' => null],
            ['id' => 2, 'name' => 'Directeur', 'username' => 'directeur', 'email' => 'directeur@colopilot.test', 'password' => '$2y$12$wv8FxLiOv6fuEnRX99UBxO3RzlhqTioQhI34VJmIOmi1oGDi7dqXK', 'role' => 'directeur', 'group_id' => null, 'phone_number' => null],
            ['id' => 3, 'name' => 'Docteur', 'username' => 'infirmier', 'email' => 'infirmier@colopilot.test', 'password' => '$2y$12$SXmoFEjnzq/iUNrMhghUzuYbCGLfVolM2IIi6ZMtJIFSr03wyNlMG', 'role' => 'infirmier', 'group_id' => null, 'phone_number' => '+221774152624'],
            ['id' => 4, 'name' => 'AL AMINE DIOP', 'username' => 'responsablevert', 'email' => 'responsablevert@colopilot.test', 'password' => '$2y$12$fgzpCU/lnqPfp7HI7veoBe331MEvxLLR8tEGAxywTY3kH0ZXHBdNO', 'role' => 'moniteur', 'group_id' => 1, 'phone_number' => null],
            ['id' => 5, 'name' => 'MARIAMA DABO', 'username' => 'responsablebleu', 'email' => 'responsablebleu@colopilot.test', 'password' => '$2y$12$19L.2nE..C/UtCwj22FfOu0eXbh1FlNF6RNHRQD682qphbPiSsdim', 'role' => 'moniteur', 'group_id' => 2, 'phone_number' => null],
            ['id' => 6, 'name' => 'FATOU NAM', 'username' => 'responsableorange', 'email' => 'responsableorange@colopilot.test', 'password' => '$2y$12$Gd5.vVT/RPNWPwNSJPvC5uf4ALylNs7FiZ4R9Tgq1LBeGfks/tcKS', 'role' => 'moniteur', 'group_id' => 3, 'phone_number' => null],
            ['id' => 7, 'name' => 'LEOPOLD MAME B. FAYE', 'username' => 'responsablenoir', 'email' => 'responsablenoir@colopilot.test', 'password' => '$2y$12$5xbFGpusNf7KevsJ/up94.4oG4gOs6UGWA.Dri/pvo004A17vv3z6', 'role' => 'moniteur', 'group_id' => 4, 'phone_number' => null],
            ['id' => 8, 'name' => 'MAIMOUNA KANDE', 'username' => 'responsablejaune', 'email' => 'responsablejaune@colopilot.test', 'password' => '$2y$12$HJY5/21fTKNhdPE.Xi3rauQyhlnVheCga9WvDyqBMdu1k81NuwAdy', 'role' => 'moniteur', 'group_id' => 5, 'phone_number' => null],
            ['id' => 9, 'name' => 'NDIANE DIAGNE', 'username' => 'responsablerouge', 'email' => 'responsablerouge@colopilot.test', 'password' => '$2y$12$I4MSwE3AQOV02h6o1Yy7V.jg/B5hWCw0eiynJ9Ob6y1hXhr4K.dZq', 'role' => 'moniteur', 'group_id' => 6, 'phone_number' => null],
            ['id' => 10, 'name' => 'MOUSSA CISS', 'email' => 'moussa-ciss-775435361@colopilot.app', 'password' => '$2y$12$LgF5NS5IPZWTinOfySQ5tu959wFh4Tx/xp6SCJt7TSFR3CLS0cz0O', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '775435361'],
            ['id' => 11, 'name' => 'AL AMINE DIOP', 'email' => 'al-amine-diop-773773461@colopilot.app', 'password' => '$2y$12$Tv74GxCQ06sjvXkx112E6eaHV51aCFHuCZe8VIw4Ke5N4e.fUWHKG', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '773773461'],
            ['id' => 12, 'name' => 'MOUSTAPHA DIEDHOU', 'email' => 'moustapha-diedhou-774074366@colopilot.app', 'password' => '$2y$12$65HFqjYoxPNFnDbwOCcQUOP/0nYBgoBUriGxNWdbg3kXfVYCpgdHC', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '774074366'],
            ['id' => 13, 'name' => 'MARIAMA DABO', 'email' => 'mariama-dabo-775504134@colopilot.app', 'password' => '$2y$12$Gb1EqgPZGsG7bcGtZjOJwevMHsKmafUhH40LW1svtrkWget2aQ/rm', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '775504134'],
            ['id' => 14, 'name' => 'NDEYE MARIAMA FAYE', 'email' => 'ndeye-mariama-faye-775772201@colopilot.app', 'password' => '$2y$12$PZwx06GDBnjrte9TsPHtueVhg8WXwyeilB/e2cW.Q/6zlH6b8lHx2', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '775772201'],
            ['id' => 15, 'name' => 'BINE TOURE', 'email' => 'bine-toure-774804196@colopilot.app', 'password' => '$2y$12$u68cbYq1DBQ5PMDB1imsIeTS9Sh7RyR0d5X6eA9uaIFgfRIV30vse', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '774804196'],
            ['id' => 16, 'name' => 'DOULA DIENG', 'email' => 'doula-dieng-774571411@colopilot.app', 'password' => '$2y$12$o2HWQMGtus47i1ZuCLoZrO.YSbVZnhBHurS3dKfh7WNuJLhrOxP12', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '774571411'],
            ['id' => 17, 'name' => 'LEOPALD MAME BIRAM FAYE', 'email' => 'leopald-mame-biram-faye-771725929@colopilot.app', 'password' => '$2y$12$q7HxB8dxd6eabxDUqNml.eanncYId7Cjc93/gqh1E7CmQAp5g665m', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '771725929'],
            ['id' => 18, 'name' => 'BABACAR NDIAYE', 'email' => 'babacar-ndiaye-773069826@colopilot.app', 'password' => '$2y$12$bJflmY5izE5N.3.J7nxgBe6ZgwgR.y/EMoF1RmiWRlQQm3/PgJxV2', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '773069826'],
            ['id' => 19, 'name' => 'FATOU THIAM', 'email' => 'fatou-thiam-771735700@colopilot.app', 'password' => '$2y$12$i3hr6s/mzxMXhrCMXFiACO.UibABLmrCDgmP05t7KCn3mQPbVFzr.', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '771735700'],
            ['id' => 20, 'name' => 'FATOU NAM', 'email' => 'fatou-nam-772785878@colopilot.app', 'password' => '$2y$12$rW9VohTY4Lw7SaW.HJE5auz97P0.Dk9pf75Clt.MD6OihfATyqEKG', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '772785878'],
            ['id' => 21, 'name' => 'PAULE SECK', 'email' => 'paule-seck-777924146@colopilot.app', 'password' => '$2y$12$2jZC3EkskE3r6lB8vwVdL..Y592MEKpwCaw4o1kk5xnXO8N.NNBoS', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '777924146'],
            ['id' => 22, 'name' => 'RAYMOND CISS', 'email' => 'raymond-ciss-777810537@colopilot.app', 'password' => '$2y$12$uVtPB1si/QkWRMmbX95za.znwn5qUY.bS9PPo4/d5VzGuSmE5ZCUK', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '777810537'],
            ['id' => 23, 'name' => 'ABDOUL AZIZ MBAYE', 'email' => 'abdoul-aziz-mbaye-776567640@colopilot.app', 'password' => '$2y$12$5Bb9tbwxtE272VoG08rrV.IRdtlnnOpINQBRR2LYXp/3N/8Vhdypm', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '776567640'],
            ['id' => 24, 'name' => 'MAIMOUNA KANDE', 'email' => 'maimouna-kande-775269763@colopilot.app', 'password' => '$2y$12$KaHp580qKCZa1i16lELLjeBo0egNBV8nw.v869CtWRxDyRLq.bWua', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '775269763'],
            ['id' => 25, 'name' => 'OUSMANE DIAGNE', 'email' => 'ousmane-diagne-772464551@colopilot.app', 'password' => '$2y$12$IINzl55h7O/u0UDNGCz4B.Kxl1CXDkdZE1J5d6/heWfreeM57yfPq', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '772464551'],
            ['id' => 26, 'name' => 'BABACAR NDIAYE', 'email' => 'babacar-ndiaye-782515799@colopilot.app', 'password' => '$2y$12$2COV2qdx9D/wavgDuxAe2OZknzrGJg/OOt13tlsni3ZB/lLYeHgtu', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '782515799'],
            ['id' => 27, 'name' => 'BAKARY SARR', 'email' => 'bakary-sarr-774050002@colopilot.app', 'password' => '$2y$12$i7owyhXXGHZ8ElmOgDXW7OYUeJywqCmzwWUE91dPu7jcsYguI6Moq', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '774050002'],
            ['id' => 28, 'name' => 'FATOU BINETOU BANE', 'email' => 'fatou-binetou-bane-776114994@colopilot.app', 'password' => '$2y$12$Bq.px0IHY1WW8TTitGg4l.0CzXoKgMVDDby0igVU6YsosVhwycLdu', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '776114994'],
            ['id' => 29, 'name' => 'BABACAR DIOUF', 'email' => 'babacar-diouf-775195225@colopilot.app', 'password' => '$2y$12$QlF6ftO9dLrddsQV7zi66uBhDdhEpQPTzIgnk04e7g4v4.2ruURwa', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '775195225'],
            ['id' => 30, 'name' => 'NDEYE COUMBA KOUATE', 'email' => 'ndeye-coumba-kouate-768857504@colopilot.app', 'password' => '$2y$12$VDqWEDuvhCecJSZLkPd1VuIpHFhbV7dMGJ6KU55MXiGWpVU3HLkU6', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '768857504'],
            ['id' => 31, 'name' => 'MADIEYE ANNE', 'email' => 'madieye-anne-779553758@colopilot.app', 'password' => '$2y$12$S1M4M3uWoNTPgNCSWTxcIuqJcPSMQJ4q.vyufkMcd0xNyENmq8bWe', 'role' => 'moniteur', 'group_id' => null, 'phone_number' => '779553758'],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
