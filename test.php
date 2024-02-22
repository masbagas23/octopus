<?php
// Soal Nomor 1
$tokens = [];
function generateToken(string $user): string {
    global $tokens;

    $token = bin2hex(random_bytes(10));

    // Check if user exists in $tokens array
    if(isset($tokens[$user])) {
        // Check the length of tokens for the user
        if(count($tokens[$user]) < 10) {
            // If less than 10 tokens, add new token
            $tokens[$user][] = $token;
        } else {
            // If user has 10 tokens, push new token and remove the oldest token
            array_shift($tokens[$user]);
            $tokens[$user][] = $token;
        }
    } else {
        // If user doesn't exist, create new entry
        $tokens[$user] = [$token];
    }
    return $token;
}
function verifyToken(string $user, string $token) : string {
    global $tokens;

    // Check if user exists in $tokens array
    if(isset($tokens[$user])) {
        // Search for the token in the user's tokens
        $index = array_search($token, $tokens[$user]);

        // If token found, remove it from the array
        if($index !== false) {
            unset($tokens[$user][$index]);
            return true;
        }
    }
    return false; // Token not found or user not found
}

// Soal Nomor 2
class Siswa {
    public $nrp;
    public $nama;
    public $daftarNilai;

    public function __construct() {
        $this->daftarNilai = []; // Initialize $daftarNilai array
    }
}

class Nilai {
    public $mapel;
    public $nilai;

    public function __construct($mapel, $nilai) {
        $this->mapel = $mapel;
        $this->nilai = $nilai;
    }
}

function generateSatuSiswa() : Siswa {
    $siswa = new Siswa();
    $nilai = new Nilai('inggris', 100);
    $siswa->nrp = 132;
    $siswa->nama='bagas';
    array_push($siswa->daftarNilai, $nilai);
    return $siswa;
}

function generateTenSiswa(int $jumlah) : array {
    $siswaList = [];

    // Array of possible subjects
    $subjects = ['inggris', 'indonesia', 'jepang'];

    // Generate ten siswa
    for ($i = 0; $i < $jumlah; $i++) {
        $siswa = new Siswa();
        $siswa->nrp = $i + 1; // Assigning NRP sequentially for demonstration
        $siswa->nama = generateRandomString($jumlah); // Generating random name with 10 characters

        // Generate random nilai for each subject
        foreach ($subjects as $subject) {
            $nilai = new Nilai($subject, rand(0, 100)); // Generating random nilai between 0 and 100
            $siswa->daftarNilai[] = $nilai;
        }

        $siswaList[] = $siswa;
    }

    return $siswaList;
}

// Function to generate random string
function generateRandomString(int $length) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Soal Nomor 3
$bangjoColor = ['merah','kuning','hijau'];
$counter = 0;
function rambuLaluLintas() : string{
    global $counter;
    global $bangjoColor;

    if($counter == 3){
        $counter = 0;
    }
    $color = $bangjoColor[$counter];
    $counter++;
    return $color;
}

// Soal Nomor 4
$randArray = [15,64,23,41,92];
function getSecondRank() : int{
    global $randArray;
    rsort($randArray);
    return $randArray[1];
}

// Soal Nomor 5
function calculateSameChar(string $kata) : string {
    // Initialize an empty associative array to count character frequencies
    $charCount = [];

    // Convert the string to lowercase to treat uppercase and lowercase characters as the same
    $kata = strtolower($kata);

    // Loop through each character in the string
    for ($i = 0; $i < strlen($kata); $i++) {
        $char = $kata[$i];

        // Skip whitespace characters
        if ($char === ' ') {
            continue;
        }

        // Increment the count for the current character in the associative array
        if (isset($charCount[$char])) {
            $charCount[$char]++;
        } else {
            $charCount[$char] = 1;
        }
    }

    // Find the character(s) with the highest frequency
    $maxCount = max($charCount);
    $maxChars = array_keys($charCount, $maxCount);

    // Construct the result string
    $result = '';
    foreach ($maxChars as $char) {
        $result .= "'{$char}' : {$maxCount}x \n";
    }

    return $result;
}

// Main loop
while (true) {
    // Prompt user for input
    echo "<<<<<<<<<<<<<<<< PILIHAN >>>>>>>>>>>>>>>>>>>>>\n";
    echo "Ketik 1 untuk soal nomor 1 \n";
    echo "Ketik 2 untuk soal nomor 2\n";
    echo "Ketik 3 untuk soal nomor 3\n";
    echo "Ketik 4 untuk soal nomor 4\n";
    echo "Ketik 5 untuk soal nomor 5\n";
    echo "Ketik 6 Untuk Exit Program \n";
    echo "Pilihan anda : ";
    $input = readline();

    // Check user input
    switch ($input) {
        case '1':
            echo "\n---------------------SOAL NOMOR 1---------------------\n";
            echo "Ketik 1 untuk Generate Token\n";
            echo "Ketik 2 untuk Lihat Daftar User \n";
            echo "Ketik 3 untuk Verify Token \n";
            echo "Ketik 4 untuk Exit \n";
            echo "Pilihan anda : ";
            $input = readline();

            switch ($input) {
                case '1':
                    echo "Masukan nama user : ";
                    $nama = readline();
                    generateToken($nama);
                    echo "\nDaftar User : ".json_encode($tokens)."\n\n";
                    break;
                case '2':
                    echo "\nDaftar User : ".json_encode($tokens)."\n\n";
                    break;
                case '3':
                    echo "Masukan nama user : ";
                    $nama = readline();
                    echo "Masukan token : ";
                    $token = readline();
                    echo "Hasil : ".verifyToken($nama,$token)."\n\n";
                    echo "\nDaftar User : ".json_encode($tokens)."\n\n";
                    break;
                default:
                    exit;
            }

            break;
        case '2':
            echo "\n---------------------SOAL NOMOR 2---------------------\n";
            // Generate 1 siswa
            $oneSiswa = generateSatuSiswa();
            echo "Generate 1 Siswa :".json_encode($oneSiswa)."\n\n";
            
            // Generate 10 siswa
            $tenSiswa = generateTenSiswa(10);
            echo "Generate 10 Siswa :".json_encode($tenSiswa)."\n\n";
            break;
        case '3':
            echo "\n---------------------SOAL NOMOR 3---------------------\n";
            echo "\nHASIL SOAL NOMOR 3 : ". rambuLaluLintas() ."\n\n";
            break;
        case '4':
            echo "\n---------------------SOAL NOMOR 4---------------------\n";
            echo "Array Random : ". json_encode($randArray)."\n";
            echo "Hasil : ". getSecondRank() ."\n\n";
            break;
        case '5':
            echo "\n---------------------SOAL NOMOR 5---------------------\n";
            echo "Masukan kata nya :";
            $kata = readline();
            echo 'Hasil nya adalah '. calculateSameChar($kata)."\n\n";
            break;
        case '6':
            echo "Exiting program.\n";
            exit;
        default:
            echo "Invalid input. Please try again.\n";
    }
}
?>
