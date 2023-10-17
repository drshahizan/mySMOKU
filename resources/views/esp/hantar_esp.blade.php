<!DOCTYPE html>
<html>
<head>
    <title>Send JSON Data</title>
</head>
<body>
    <h1>Send JSON Data</h1>
    <form action="http://espbstg.mohe.gov.my/api/studentsInfo.php" method="post">
        <label for="data">JSON Data (Array of Objects):</label>
        <textarea name="data" id="data" rows="10" cols="50">
            {{$jsonContent}}
{{-- [
  {
    "nokp": "1234567890",
    "nama": "John Doe",
    "tarikh_lahir": "1990-01-15",
    "negeri_lahir": "Selangor",
    "jantina": "Male",
    "agama": "Islam",
    "keturunan": "Malay",
    "warganegara": "Malaysian",
    "alamat1": "123 Main Street",
    "alamat2": "Apt 4B",
    "poskod": "12345",
    "bandar": "Cityville",
    "negeri": "Selangor",
    "telefon_hp": "555-123-4567",
    "alamat01": "456 Elm Street",
    "alamat02": "Unit 7C",
    "alamat03": "",
    "telefon_o": "555-987-6543",
    "program": "Bachelor of Science",
    "peringkat": "Degree",
    "tahun_tawar": "2023",
    "tahun_taja": "2023",
    "tempoh_taja": "4 years",
    "tarikh_taja": "2023-09-01",
    "sesi_mula": "September",
    "sesi_tamat": "June",
    "institut": "University of Example",
    "kursus": "Computer Science",
    "tarikh_tamat": "2027-06-30",
    "no_akaun": "1234567890",
    "nama_akaun": "John Doe",
    "kod_bank": "ABC123",
    "nama_bank": "Example Bank",
    "id_permohonan": "987654321"
  },
  {
    "nokp": "9876543210",
    "nama": "Jane Smith",
    "tarikh_lahir": "1992-05-20",
    "negeri_lahir": "Kuala Lumpur",
    "jantina": "Female",
    "agama": "Christian",
    "keturunan": "Chinese",
    "warganegara": "Malaysian",
    "alamat1": "456 Oak Avenue",
    "alamat2": "Suite 2C",
    "poskod": "54321",
    "bandar": "Townsville",
    "negeri": "Selangor",
    "telefon_hp": "555-987-6543",
    "alamat01": "789 Pine Street",
    "alamat02": "Unit 3D",
    "alamat03": "",
    "telefon_o": "555-123-4567",
    "program": "Master of Business Administration",
    "peringkat": "Master's",
    "tahun_tawar": "2024",
    "tahun_taja": "2024",
    "tempoh_taja": "2 years",
    "tarikh_taja": "2024-08-15",
    "sesi_mula": "August",
    "sesi_tamat": "May",
    "institut": "Business School",
    "kursus": "MBA",
    "tarikh_tamat": "2026-05-30",
    "no_akaun": "9876543210",
    "nama_akaun": "Jane Smith",
    "kod_bank": "XYZ789",
    "nama_bank": "Another Bank",
    "id_permohonan": "123456789"
  }
] --}}
        </textarea>
        <br>
        <input type="submit" value="Send JSON">
    </form>
</body>
</html>