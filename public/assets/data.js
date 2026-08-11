/* ============================================================
   IMT DISCOVERY: Shared data & scoring engine
   Prototype only. Content condensed from IMT Knowledge Base
   ============================================================ */

/*
 * Struktur per driver: 8 soal inti (mengukur driver) + 2 soal tersembunyi
 * (1 Consistency, 1 Authenticity) = tetap 10 soal/driver, 50 soal total.
 * - type "consistency": parafrase dari salah satu soal inti (pairWith) di
 *   driver yang sama, arah setuju yang sama. Jawaban yang jauh berbeda dari
 *   soal aslinya mengindikasikan jawaban tidak cermat/tidak konsisten.
 * - type "authenticity": pernyataan absolut ("selalu"/"tidak pernah") yang
 *   secara realistis jarang benar-benar 100% berlaku pada siapa pun. Skor
 *   sangat tinggi berulang pada item ini mengindikasikan social-desirability
 *   bias (menjawab yang "terdengar baik", bukan yang jujur).
 * Kedua jenis ini TIDAK ikut dihitung ke skor 5 Human Drivers™ (hanya "core"
 * yang dihitung), karena keduanya murni lapisan validitas.
 */
let IMT_QUESTIONS = [
  // SECURITY 1-10 (8 core + 2 validity)
  { id: 1, driver: "security", type: "core", subComposite: "stability", text: "Saya merasa lebih nyaman ketika hari-hari saya berjalan cukup teratur." },
  { id: 2, driver: "security", type: "core", subComposite: "certainty", text: "Sebelum mengambil keputusan penting, saya cenderung mempertimbangkan risiko yang mungkin muncul." },
  { id: 3, driver: "security", type: "core", subComposite: "certainty", text: "Saya lebih suka mengetahui apa yang akan terjadi daripada menghadapi banyak ketidakpastian." },
  { id: 4, driver: "security", type: "core", subComposite: "stability", text: "Saya merasa lebih nyaman ketika dapat menjalankan hal-hal yang sudah saya rencanakan sebelumnya." },
  { id: 5, driver: "security", type: "core", subComposite: "resilience", text: "Saya cukup cepat bangkit kembali setelah menghadapi kesulitan atau kegagalan." },
  { id: 6, driver: "security", type: "core", subComposite: "trustworthiness", text: "Saya berusaha menepati apa yang sudah saya janjikan, meskipun tidak ada yang mengawasi." },
  { id: 7, driver: "security", type: "core", subComposite: "trustworthiness", text: "Saya berusaha konsisten antara apa yang saya katakan dan apa yang saya lakukan." },
  { id: 8, driver: "security", type: "core", subComposite: "authenticity", text: "Saya cukup nyaman menjadi diri sendiri, bahkan ketika berbeda dari kebanyakan orang di sekitar saya." },
  { id: 9, driver: "security", type: "consistency", pairWith: 1, text: "Saya cenderung merasa terganggu ketika rutinitas harian saya berubah secara tiba-tiba." },
  { id: 10, driver: "security", type: "authenticity", text: "Saya selalu berhasil tetap tenang dalam situasi apa pun, tanpa terkecuali." },
  // SIGNIFICANCE 11-20 (8 core + 2 validity)
  { id: 11, driver: "significance", type: "core", subComposite: "achievement", text: "Saya merasa puas ketika berhasil mencapai sesuatu yang penting bagi saya." },
  { id: 12, driver: "significance", type: "core", subComposite: "recognition", text: "Saya ingin hidup saya mencerminkan kualitas terbaik yang saya miliki." },
  { id: 13, driver: "significance", type: "core", subComposite: "achievement", text: "Saya cenderung menetapkan standar yang cukup tinggi terhadap hasil yang saya kerjakan." },
  { id: 14, driver: "significance", type: "core", subComposite: "recognition", text: "Saya senang mengetahui bahwa usaha saya memberikan hasil yang nyata." },
  { id: 15, driver: "significance", type: "core", subComposite: "self_worth", text: "Saya menghargai diri saya sendiri, terlepas dari hasil yang saya capai." },
  { id: 16, driver: "significance", type: "core", subComposite: "competence", text: "Saya merasa termotivasi ketika melihat perkembangan kemampuan saya." },
  { id: 17, driver: "significance", type: "core", subComposite: "self_worth", text: "Saya cukup nyaman menyampaikan pendapat saya, meski berisiko tidak disetujui semua orang." },
  { id: 18, driver: "significance", type: "core", subComposite: "confidence", text: "Saya menikmati tantangan yang memungkinkan saya menunjukkan kemampuan terbaik saya." },
  { id: 19, driver: "significance", type: "consistency", pairWith: 11, text: "Saya jarang merasa benar-benar puas kecuali pencapaian saya diakui sebagai sesuatu yang berarti." },
  { id: 20, driver: "significance", type: "authenticity", text: "Saya tidak pernah merasa perlu diakui atas apa yang saya capai." },
  // CONNECTION 21-30 (8 core + 2 validity)
  { id: 21, driver: "connection", type: "core", subComposite: "belonging", text: "Saya merasa lebih nyaman ketika menjadi bagian dari lingkungan yang menerima diri saya apa adanya." },
  { id: 22, driver: "connection", type: "core", subComposite: "belonging", text: "Dukungan dari orang-orang terdekat biasanya memberi saya energi tambahan untuk menjalani berbagai tantangan." },
  { id: 23, driver: "connection", type: "core", subComposite: "trust", text: "Saya membutuhkan waktu untuk membangun kedekatan sebelum benar-benar mempercayai seseorang." },
  { id: 24, driver: "connection", type: "core", subComposite: "trust", text: "Saya lebih mudah merasa terhubung dengan orang yang konsisten antara perkataan dan tindakannya." },
  { id: 25, driver: "connection", type: "core", subComposite: "empathy", text: "Dalam percakapan, saya sering mencoba memahami perasaan seseorang sebelum fokus pada solusi yang diberikan." },
  { id: 26, driver: "connection", type: "core", subComposite: "empathy", text: "Saya sering menjadi orang yang dicari ketika seseorang ingin berbicara tentang masalah pribadinya." },
  { id: 27, driver: "connection", type: "core", subComposite: "intimacy", text: "Saya biasanya tetap berusaha menjaga komunikasi dengan orang-orang yang penting bagi saya meskipun aktivitas sedang padat." },
  { id: 28, driver: "connection", type: "core", subComposite: "acceptance", text: "Saya cukup mudah menerima orang lain apa adanya, meskipun cara pandang mereka berbeda dari saya." },
  { id: 29, driver: "connection", type: "consistency", pairWith: 21, text: "Saya merasa tidak nyaman berada di lingkungan yang tidak benar-benar menerima saya apa adanya." },
  { id: 30, driver: "connection", type: "authenticity", text: "Saya selalu bisa mempercayai orang lain sepenuhnya sejak pertama kali bertemu." },
  // GROWTH 31-40 (8 core + 2 validity)
  { id: 31, driver: "growth", type: "core", subComposite: "curiosity", text: "Saya biasanya tertarik memahami sesuatu yang sebelumnya belum saya ketahui." },
  { id: 32, driver: "growth", type: "core", subComposite: "curiosity", text: "Saya sering penasaran terhadap ide atau sudut pandang yang berbeda dari yang biasa saya temui." },
  { id: 33, driver: "growth", type: "core", subComposite: "self_expansion", text: "Saya sering merasa tidak puas jika terlalu lama berada dalam rutinitas yang sama tanpa tantangan atau pembelajaran baru." },
  { id: 34, driver: "growth", type: "core", subComposite: "learning", text: "Ketika menemukan informasi yang bertentangan dengan keyakinan saya, saya biasanya tertarik untuk memahaminya terlebih dahulu sebelum menolaknya." },
  { id: 35, driver: "growth", type: "core", subComposite: "adaptability", text: "Saya cukup terbuka untuk menyesuaikan cara berpikir atau bertindak ketika menemukan pendekatan yang lebih baik." },
  { id: 36, driver: "growth", type: "core", subComposite: "learning", text: "Setelah melakukan kesalahan, saya biasanya lebih fokus mencari pelajaran yang bisa diambil daripada menyalahkan keadaan." },
  { id: 37, driver: "growth", type: "core", subComposite: "adaptability", text: "Saya cukup cepat menyesuaikan diri ketika rencana yang sudah disusun berubah tiba-tiba." },
  { id: 38, driver: "growth", type: "core", subComposite: "mastery", text: "Saya berlatih secara konsisten untuk terus meningkatkan kemampuan saya di bidang yang saya tekuni." },
  { id: 39, driver: "growth", type: "consistency", pairWith: 31, text: "Saya senang mempelajari topik-topik yang benar-benar baru dan belum saya kenal sebelumnya." },
  { id: 40, driver: "growth", type: "authenticity", text: "Saya selalu menikmati proses belajar apa pun, tanpa pernah merasa bosan atau frustrasi." },
  // CONTRIBUTION 41-50 (8 core + 2 validity)
  { id: 41, driver: "contribution", type: "core", subComposite: "service", text: "Saya biasanya lebih bersemangat ketika mengetahui bahwa apa yang saya lakukan akan memberi manfaat bagi orang lain." },
  { id: 42, driver: "contribution", type: "core", subComposite: "service", text: "Saya lebih tertarik pada aktivitas yang memberi manfaat bagi banyak orang dibanding aktivitas yang hanya menguntungkan diri saya sendiri." },
  { id: 43, driver: "contribution", type: "core", subComposite: "influence", text: "Saya sering memikirkan bagaimana tindakan saya memengaruhi orang lain di sekitar saya." },
  { id: 44, driver: "contribution", type: "core", subComposite: "value_creation", text: "Saya merasa pekerjaan atau aktivitas menjadi lebih berharga ketika memberikan dampak nyata bagi orang lain." },
  { id: 45, driver: "contribution", type: "core", subComposite: "value_creation", text: "Saya menikmati menggunakan kemampuan yang saya miliki untuk memberi manfaat kepada orang lain." },
  { id: 46, driver: "contribution", type: "core", subComposite: "stewardship", text: "Saya merasa puas ketika dapat berkontribusi pada keberhasilan atau perkembangan orang lain." },
  { id: 47, driver: "contribution", type: "core", subComposite: "legacy", text: "Sebelum mengambil keputusan penting, saya sering mempertimbangkan bagaimana dampaknya terhadap orang lain dalam jangka panjang." },
  { id: 48, driver: "contribution", type: "core", subComposite: "influence", text: "Saya sering menjadi sosok yang orang lain jadikan contoh atau teladan dalam bersikap." },
  { id: 49, driver: "contribution", type: "consistency", pairWith: 41, text: "Saya merasa kurang bersemangat mengerjakan sesuatu yang tidak memberi manfaat bagi orang lain." },
  { id: 50, driver: "contribution", type: "authenticity", text: "Saya selalu mengutamakan kepentingan orang lain di atas kepentingan saya sendiri, tanpa pengecualian." },
  // MODUL VALIDITAS TAMBAHAN 51-56: tidak terikat ke satu driver tertentu,
  // tidak dihitung ke skor Driver (imtScore hanya menjumlahkan type "core").
  // Ditempatkan sebagai blok terpisah di akhir tes agar 8 soal inti/driver
  // di atas tidak perlu dikurangi lagi.
  { id: 51, driver: "general", type: "module_consistency", pairWith: 52, text: "Saya berusaha membaca setiap pernyataan dengan cermat sebelum menjawab." },
  { id: 52, driver: "general", type: "module_consistency", pairWith: 51, text: "Saya meluangkan waktu untuk memahami maksud sebuah pernyataan sebelum memilih jawaban." },
  { id: 53, driver: "general", type: "module_authenticity", text: "Saya tidak pernah merasa ragu ketika harus mengambil keputusan penting." },
  { id: 54, driver: "general", type: "module_authenticity", text: "Saya selalu bisa mengendalikan emosi saya dalam situasi apa pun." },
  { id: 55, driver: "general", type: "module_consistency", pairWith: 56, text: "Saya cenderung memberi jawaban yang benar-benar mencerminkan diri saya, bukan yang terdengar ideal." },
  { id: 56, driver: "general", type: "module_consistency", pairWith: 55, text: "Saya lebih memilih menjawab secara jujur meskipun jawabannya tidak terlihat sempurna." },
];

const IMT_DRIVERS = {
  security: {
    name: "Security", label: "SECURITY", color: "#2f6fed", icon: "1",
    tagline: "The Stability Driver",
    pitch: "Driver yang membuat Anda mempersiapkan segala sesuatu sebelum melangkah, bukan sekadar mengikuti arus.",
    coreNeed: "Anda merasa paling tenang saat hidup terasa bisa diprediksi dan berada dalam kendali Anda sendiri.",
    coreFear: "Perubahan mendadak yang datang tanpa peringatan, dan membuat Anda kehilangan pijakan, adalah hal yang paling ingin Anda hindari.",
    bands: {
      low: { title: "Pencari Tantangan", desc: "Anda cukup nyaman dengan ketidakpastian dan tidak terlalu bergantung pada rencana yang kaku. Anda mudah beradaptasi saat situasi berubah mendadak.", tags: ["Fleksibel", "Berani Ambil Risiko", "Adaptif"] },
      mid: { title: "Perencana Seimbang", desc: "Anda menghargai keteraturan namun tetap bisa menyesuaikan diri saat keadaan berubah. Anda mempersiapkan diri tanpa menjadi terlalu kaku.", tags: ["Terorganisir", "Realistis", "Tenang"] },
      high: { title: "Penjaga Stabilitas", desc: "Anda menghargai stabilitas, keamanan, dan kendali atas segala hal. Anda cenderung mempersiapkan diri dan dapat diandalkan.", tags: ["Siap", "Bertanggung Jawab", "Konsisten"] },
      vhigh: { title: "Pengawal Ketahanan", desc: "Kebutuhan Anda akan rasa aman sangat kuat, sehingga Anda membangun fondasi yang sangat kokoh sebelum mengambil langkah apa pun.", tags: ["Waspada", "Teliti", "Sangat Andal"] },
    }
  },
  significance: {
    name: "Significance", label: "SIGNIFICANCE", color: "#e8862e", icon: "2",
    tagline: "The Achievement Driver",
    pitch: "Driver yang mendorong Anda mengejar hasil yang benar-benar bisa dibanggakan, bukan sekadar cukup.",
    coreNeed: "Anda ingin tahu bahwa apa yang Anda kerjakan benar-benar berarti, bukan sekadar rutinitas yang lewat begitu saja.",
    coreFear: "Bayangan menjalani hidup yang datar-datar saja, tanpa jejak yang benar-benar diingat orang, cukup mengganggu Anda.",
    bands: {
      low: { title: "Jiwa Rendah Hati", desc: "Anda tidak terlalu terdorong oleh status atau pengakuan publik. Anda lebih memilih fokus pada kualitas dari hasil yang bermakna.", tags: ["Rendah Hati", "Fokus", "Autentik"] },
      mid: { title: "Pengejar Kualitas", desc: "Anda memiliki standar pribadi yang cukup jelas dan menghargai hasil kerja yang baik, tanpa terlalu terpaku pada pengakuan orang lain.", tags: ["Berstandar", "Tekun", "Seimbang"] },
      high: { title: "Pencapai Berdedikasi", desc: "Anda termotivasi kuat oleh pencapaian, keunggulan, dan hasil yang nyata. Anda menetapkan standar tinggi bagi diri sendiri.", tags: ["Ambisius", "Berorientasi Hasil", "Percaya Diri"] },
      vhigh: { title: "Pengukir Legasi", desc: "Dorongan Anda untuk berprestasi dan diakui sangat besar, sehingga Anda terus mengejar standar yang lebih tinggi dari waktu ke waktu.", tags: ["Sangat Ambisius", "Kompetitif", "Berorientasi Legasi"] },
    }
  },
  connection: {
    name: "Connection", label: "CONNECTION", color: "#3aa65a", icon: "3",
    tagline: "The Relationship Driver",
    pitch: "Driver yang membuat hubungan dengan orang lain terasa sama pentingnya dengan pencapaian apa pun.",
    coreNeed: "Hidup terasa lebih utuh bagi Anda ketika ada orang-orang yang benar-benar menerima dan memahami siapa Anda.",
    coreFear: "Merasa sendirian atau diabaikan oleh orang-orang yang Anda pedulikan adalah salah satu hal terberat yang bisa Anda alami.",
    bands: {
      low: { title: "Penjelajah Mandiri", desc: "Anda cukup nyaman mengandalkan diri sendiri dan tidak terlalu membutuhkan kedekatan emosional yang mendalam untuk merasa baik-baik saja.", tags: ["Mandiri", "Objektif", "Tenang Sendiri"] },
      mid: { title: "Pembangun Hubungan", desc: "Anda menikmati hubungan yang sehat namun tetap mampu berdiri sendiri ketika diperlukan. Anda selektif dan menghargai kualitas kedekatan.", tags: ["Selektif", "Stabil", "Suportif"] },
      high: { title: "Penghubung Hangat", desc: "Anda peduli terhadap hubungan secara mendalam. Anda menghargai loyalitas, kepercayaan, dan keharmonisan dengan orang lain.", tags: ["Empatik", "Loyal", "Suportif"] },
      vhigh: { title: "Pembangun Komunitas", desc: "Kebutuhan Anda akan kedekatan emosional sangat kuat, sehingga Anda sering menjadi perekat yang menyatukan orang-orang di sekitar Anda.", tags: ["Sangat Empatik", "Penyatu", "Peka Sosial"] },
    }
  },
  growth: {
    name: "Growth", label: "GROWTH", color: "#7a5cc7", icon: "4",
    tagline: "The Development Driver",
    pitch: "Driver yang membuat Anda gelisah kalau terlalu lama berada di zona yang itu-itu saja.",
    coreNeed: "Anda merasa paling hidup ketika sedang mempelajari sesuatu yang baru dan menjadi versi diri yang lebih baik dari kemarin.",
    coreFear: "Terjebak di tempat yang sama tanpa kemajuan, seolah waktu berhenti untuk Anda, adalah ketakutan yang cukup dalam bagi Anda.",
    bands: {
      low: { title: "Penikmat Rutinitas", desc: "Anda merasa nyaman dengan cara-cara yang sudah teruji dan tidak terlalu terdorong untuk terus mencari hal baru.", tags: ["Konsisten", "Fokus", "Praktis"] },
      mid: { title: "Pembelajar Praktis", desc: "Anda cukup terbuka terhadap hal baru dan senang belajar, terutama ketika relevan dengan kebutuhan nyata Anda.", tags: ["Terbuka", "Reflektif", "Praktis"] },
      high: { title: "Pencari Wawasan", desc: "Anda menikmati proses belajar dan mengembangkan diri. Anda terbuka pada pengalaman baru dan ingin menjadi lebih baik.", tags: ["Penasaran", "Berpikiran Terbuka", "Adaptif"] },
      vhigh: { title: "Penjelajah Tanpa Batas", desc: "Dorongan Anda untuk belajar dan berkembang sangat besar, sehingga Anda terus mencari tantangan dan wawasan baru tanpa henti.", tags: ["Sangat Adaptif", "Visioner", "Eksploratif"] },
    }
  },
  contribution: {
    name: "Contribution", label: "CONTRIBUTION", color: "#1f8a6e", icon: "5",
    tagline: "The Purpose Driver",
    pitch: "Driver yang membuat Anda merasa paling puas saat usaha Anda benar-benar menolong orang lain.",
    coreNeed: "Anda merasa paling berharga saat tahu bahwa yang Anda lakukan benar-benar membantu dan bermakna bagi orang lain.",
    coreFear: "Pikiran bahwa keberadaan Anda tidak membuat perbedaan apa pun bagi siapa pun adalah sesuatu yang cukup menghantui Anda.",
    bands: {
      low: { title: "Fokus Personal", desc: "Anda cenderung memprioritaskan tujuan pribadi terlebih dahulu sebelum memikirkan dampaknya bagi orang lain secara luas.", tags: ["Fokus Diri", "Efisien", "Berorientasi Tujuan"] },
      mid: { title: "Pemberi Manfaat", desc: "Anda cukup peduli terhadap dampak dari apa yang Anda lakukan terhadap orang lain, meski tidak selalu menjadi prioritas utama.", tags: ["Peduli", "Kolaboratif", "Seimbang"] },
      high: { title: "Kontributor Terpercaya", desc: "Anda termotivasi untuk membantu orang lain dan membawa pengaruh positif. Anda merasa terpenuhi ketika pekerjaan Anda bermanfaat bagi banyak orang.", tags: ["Berdampak", "Membantu", "Penuh Tujuan"] },
      vhigh: { title: "Pembawa Dampak", desc: "Dorongan Anda untuk memberi dampak sangat besar, sehingga Anda merasa hidup paling bermakna ketika bisa melayani sesuatu yang lebih besar dari diri sendiri.", tags: ["Sangat Berdampak", "Berorientasi Layanan", "Visioner Sosial"] },
    }
  },
};

/* ============================================================
   Narasi gabungan 2 driver teratas, bukan lima tulisan terpisah.
   Pola: "[Driver #1] adalah [metafora]; [apa yang dilakukannya];
   tapi karena [Driver #2] juga kuat, [bagaimana #2 mengarahkannya]."
   5 metafora (primary) × 5 modifier (secondary) disusun agar tiap
   kombinasi tetap terbaca alami tanpa harus menulis 20 paragraf
   terpisah. Lihat skill imt-warm-reporting.
   ============================================================ */
const IMT_DRIVER_METAPHOR = {
  security: "adalah jangkar Anda. Bagian dari diri Anda ini selalu memastikan ada pijakan kokoh sebelum melangkah",
  significance: "adalah kompas ambisi Anda. Bagian dari diri Anda ini terus bertanya apakah hasil ini sudah cukup baik",
  connection: "adalah radar sosial Anda. Bagian dari diri Anda ini otomatis membaca suasana dan orang-orang di sekitar",
  growth: "adalah rasa ingin tahu Anda. Bagian dari diri Anda ini gelisah kalau berhenti belajar",
  contribution: "adalah kompas makna Anda. Bagian dari diri Anda ini terus bertanya apakah ini benar-benar berguna bagi orang lain",
};

/**
 * Frasa makna singkat per driver, dalam bahasa sehari-hari (bukan nama
 * driver-nya). Dipakai untuk menyebut driver ke-3 di "Apa Artinya" tanpa
 * menyebut istilah teknisnya secara mentah; lihat imtComboNarrative().
 */
const IMT_DRIVER_ESSENCE = {
  security: "merasa aman dan punya kendali atas hidup Anda",
  significance: "diakui dan dianggap benar-benar bernilai",
  connection: "merasa dekat dan terhubung dengan orang-orang di sekitar Anda",
  growth: "terus belajar dan menjadi lebih baik",
  contribution: "memberi dampak yang benar-benar berguna bagi orang lain",
};

const IMT_DRIVER_MODIFIER = {
  security: "namun dorongan itu selalu diimbangi oleh kebutuhan untuk merasa punya pijakan yang jelas sebelum benar-benar melangkah, sehingga Anda jarang bergerak tanpa rencana cadangan di kantong.",
  significance: "namun dorongan itu jarang terasa selesai sebelum hasilnya benar-benar diakui sebagai sesuatu yang berarti, bukan sekadar cukup, tapi terasa membanggakan.",
  connection: "namun dorongan itu hampir selalu melibatkan orang lain di dalamnya. Bagi Anda, pencapaian terasa jauh lebih bermakna kalau dijalani bersama, bukan sendirian.",
  growth: "namun dorongan itu terus mencari cara yang lebih baik. Begitu satu cara mulai terasa itu-itu saja, Anda mulai gelisah mencari pendekatan baru.",
  contribution: "namun dorongan itu hampir selalu berujung pada satu pertanyaan diam-diam: apakah ini benar-benar berguna bagi orang lain, bukan cuma untuk diri sendiri.",
};

/**
 * Merangkai driver #1 dan #2 jadi satu narasi utuh, bukan dua definisi
 * terpisah. topKey dan secondKey harus berbeda.
 */
function imtComboNarrative(topKey, secondKey) {
  const topName = IMT_DRIVERS[topKey].name;
  const metaphor = IMT_DRIVER_METAPHOR[topKey];
  const modifier = IMT_DRIVER_MODIFIER[secondKey];
  const modifierCapitalized = modifier.charAt(0).toUpperCase() + modifier.slice(1);
  return `${topName} ${metaphor}. ${modifierCapitalized}`;
}

/* ============================================================
   Skenario sehari-hari per driver, dipakai agar penjelasan Driver
   Dynamics tidak hanya berupa daftar sifat, tapi menempatkan pembaca
   di satu momen konkret yang bisa mereka bayangkan sendiri.
   ============================================================ */
const IMT_DRIVER_SCENES = {
  security: "Bayangkan rencana Anda mendadak berantakan sejam sebelum tenggat. Momen seperti ini adalah saat Driver Security Anda paling terlihat, entah membuat Anda tenang karena sudah punya rencana cadangan, atau membuat Anda sibuk mencari kepastian.",
  significance: "Bayangkan hasil kerja Anda dipuji seadanya, bukan diakui secara khusus. Momen seperti ini adalah saat Driver Significance Anda paling terlihat, entah mendorong Anda membuktikan diri lebih jauh, atau membuat Anda merasa kurang dihargai.",
  connection: "Bayangkan masuk ke ruangan yang sedang tegang. Momen seperti ini adalah saat Driver Connection Anda paling terlihat, Anda hampir refleks membaca suasana dan siapa yang mulai tidak nyaman, sebelum sempat memikirkan argumennya sendiri.",
  growth: "Bayangkan menjalani rutinitas yang sama persis selama berbulan-bulan tanpa tantangan baru. Momen seperti ini adalah saat Driver Growth Anda paling terlihat, biasanya muncul sebagai kegelisahan halus yang mendorong Anda mencari sesuatu yang baru.",
  contribution: "Bayangkan menyelesaikan sesuatu yang bagus tapi tidak berdampak ke siapa pun. Momen seperti ini adalah saat Driver Contribution Anda paling terlihat, hasilnya terasa kurang berarti sampai Anda tahu itu benar-benar membantu seseorang.",
};

/* ============================================================
   Langkah pengembangan yang konkret & spesifik per driver (dipakai
   untuk driver dengan skor terendah, sisi yang paling punya ruang
   untuk dikembangkan). Bukan saran generik seperti "refleksikan hasil
   ini", tapi satu tindakan nyata yang hanya masuk akal untuk driver itu.
   ============================================================ */
const IMT_GROWTH_ACTIONS = {
  security: "Minggu ini, sebelum memulai sesuatu yang penting, coba tuliskan satu rencana cadangan sederhana, bukan untuk membuat Anda ragu, tapi untuk melatih rasa aman yang lebih tahan banting.",
  significance: "Minggu ini, coba selesaikan satu hal sampai benar-benar tuntas dan beri diri Anda pengakuan atas itu, tanpa menunggu orang lain memujinya lebih dulu.",
  connection: "Minggu ini, coba hubungi satu orang yang sudah lama tidak Anda ajak bicara, bukan karena ada perlunya, tapi sekadar untuk menjaga hubungan itu tetap hidup.",
  growth: "Minggu ini, coba pelajari satu hal kecil yang benar-benar di luar rutinitas Anda, sesuatu yang tidak ada hubungannya dengan pekerjaan.",
  contribution: "Minggu ini, coba lakukan satu hal kecil yang manfaatnya langsung terasa oleh orang lain, sekecil apa pun itu.",
};

const IMT_ARCHETYPES = {
  security: {
    name: "The Guardian™", icon: "🛡️",
    desc: "Anda adalah penjaga stabilitas, orang yang diandalkan saat semua orang butuh kepastian. Anda membangun fondasi yang kokoh sebelum mengambil langkah besar, dan menjadi jangkar yang menenangkan bagi tim atau keluarga Anda."
  },
  significance: {
    name: "The Achiever™", icon: "🏆",
    desc: "Anda adalah pengejar keunggulan yang didorong oleh standar tinggi dan hasrat untuk menghasilkan karya terbaik. Anda menetapkan tolok ukur, mendorong diri sendiri lebih jauh, dan ingin dikenal karena kualitas nyata yang Anda ciptakan."
  },
  connection: {
    name: "The Connector™", icon: "💛",
    desc: "Anda adalah penghubung, orang yang membuat orang lain merasa dilihat dan dipahami. Anda membangun kepercayaan dengan cepat dan sering menjadi perekat yang menyatukan tim atau komunitas."
  },
  growth: {
    name: "The Explorer™", icon: "🧭",
    desc: "Anda adalah penjelajah yang selalu mencari wawasan, pengalaman, dan cara baru untuk berkembang. Anda merasa hidup paling saat menghadapi tantangan yang mendorong Anda keluar dari zona nyaman."
  },
  contribution: {
    name: "The Contributor™", icon: "🤝",
    desc: "Anda adalah pemberi dampak, seseorang yang mengukur keberhasilan dari manfaat nyata bagi orang lain. Pengakuan pribadi bukan prioritas utama Anda; Anda lebih memilih membiarkan dampak Anda berbicara."
  },
};

/* ============================================================
   Driver Synergy Matrix™: 10 kombinasi 2 driver teratas.
   Sumber: Assessment/Drivers Synergy Matrix (10 dokumen resmi).
   Ditulis ulang dengan suara sendiri (bukan kutipan KB) mengikuti
   skill imt-warm-reporting; nama arketipe & konsep inti tetap
   mengacu KB, tapi kalimatnya baru.

   Ini adalah level "arketipe" utama yang dipakai di report.html,
   menggantikan arketipe single-driver (IMT_ARCHETYPES di atas tetap
   dipakai sebagai label ringkas di dashboard/admin/team). Karena
   arketipe di report sekarang ditentukan oleh KOMBINASI 2 driver
   teratas (bukan cuma driver #1), dua peserta dengan driver dominan
   yang sama tapi driver #2 berbeda akan mendapat arketipe berbeda.
   Inilah mekanisme utama supaya laporan tidak terasa duplikat.
   ============================================================ */
const IMT_SYNERGY_MATRIX = {
  security_significance: {
    name: "The Strategic Achiever™",
    desire: "Anda ingin membangun kehidupan yang aman sekaligus dihormati karena hasil nyata yang Anda capai.",
    fear: "Kehilangan stabilitas yang sudah susah payah Anda bangun, atau dianggap tidak kompeten setelah berusaha sekeras itu.",
    strengths: "Anda berpikir strategis, bisa diandalkan dalam jangka panjang, dan membangun kredibilitas lewat konsistensi, bukan lewat drama.",
    blindSpot: "Standar yang Anda tetapkan untuk diri sendiri bisa jadi terlalu tinggi. Takut gagal membuat Anda memegang kendali erat-erat dan sulit melepaskannya, bahkan ketika sudah waktunya.",
    keyQuestion: "Apakah Anda mengejar ini karena benar-benar penting bagi Anda, atau karena takut terlihat gagal di mata orang lain?",
  },
  security_connection: {
    name: "The Trusted Builder™",
    desire: "Anda ingin membangun kehidupan yang aman bersama orang-orang yang benar-benar bisa Anda percaya.",
    fear: "Kehilangan rasa aman itu sendiri, entah lewat ditinggalkan, dikhianati, atau kehilangan orang yang penting bagi Anda.",
    strengths: "Loyalitas Anda jarang goyah. Anda sering jadi sosok paling bisa diandalkan di lingkaran terdekat, dan pandai membangun kepercayaan pelan-pelan tapi kokoh.",
    blindSpot: "Karena begitu ingin menjaga hubungan tetap aman, Anda cenderung menghindari konflik yang sebenarnya perlu diselesaikan, dan sulit menerima perubahan dalam hubungan yang sudah nyaman.",
    keyQuestion: "Apakah Anda menjaga hubungan ini karena memang sehat, atau karena takut kehilangan rasa aman yang sudah Anda bangun?",
  },
  security_growth: {
    name: "The Strategic Explorer™",
    desire: "Anda ingin terus berkembang tanpa harus mengorbankan stabilitas yang sudah susah payah Anda bangun.",
    fear: "Terjebak stagnan di satu tempat, atau sebaliknya, mengambil langkah terlalu berisiko yang merusak semua yang sudah Anda miliki.",
    strengths: "Anda belajar dengan cara yang terukur, tidak asal lompat, dan selalu mempersiapkan diri sebelum benar-benar mengambil peluang baru.",
    blindSpot: "Anda bisa terlalu lama menimbang sampai peluangnya keburu hilang. Kebutuhan akan kepastian kadang menahan langkah yang sebenarnya sudah cukup matang untuk diambil.",
    keyQuestion: "Apakah Anda sedang benar-benar mempersiapkan diri, atau sedang menunda karena belum merasa cukup aman untuk mulai?",
  },
  security_contribution: {
    name: "The Purposeful Guardian™",
    desire: "Anda ingin membangun sesuatu yang aman, bernilai, dan benar-benar bermanfaat bagi banyak orang.",
    fear: "Apa yang sudah Anda bangun ternyata tidak memberi manfaat berarti, atau hilang begitu saja tanpa membekas.",
    strengths: "Anda bertanggung jawab dalam jangka panjang, menjaga sesuatu tetap berjalan dengan konsisten, dan jadi sosok yang diandalkan saat orang lain butuh kepastian.",
    blindSpot: "Rasa tanggung jawab Anda bisa berubah jadi beban yang terlalu berat untuk dipikul sendiri, sehingga sulit melepas kendali meski sebenarnya sudah waktunya orang lain ikut ambil bagian.",
    keyQuestion: "Apakah Anda menjaga ini karena tanggung jawab yang sehat, atau karena merasa semuanya akan runtuh tanpa Anda?",
  },
  significance_connection: {
    name: "The Influential Connector™",
    desire: "Anda ingin menjadi sosok yang dihargai, dipercaya, dan memberi pengaruh positif bagi orang-orang di sekitar Anda.",
    fear: "Dianggap tidak penting, atau kehilangan hubungan dengan orang-orang yang selama ini jadi tempat Anda bersandar.",
    strengths: "Anda pandai membaca dinamika sosial, membangun jaringan yang terasa tulus, bukan sekadar transaksional, dan cara bicara Anda cenderung menggerakkan orang lain.",
    blindSpot: "Nilai diri Anda kadang terlalu bergantung pada bagaimana orang lain memandang Anda, sehingga sulit menetapkan batasan karena takut mengecewakan.",
    keyQuestion: "Apakah Anda melakukan ini karena benar-benar peduli, atau karena butuh diakui oleh orang-orang di sekitar Anda?",
  },
  significance_growth: {
    name: "The Ambitious Innovator™",
    desire: "Anda ingin terus berkembang dan mencapai sesuatu yang membuat hidup Anda terasa bermakna sekaligus membanggakan.",
    fear: "Menjadi biasa-biasa saja, atau gagal mencapai potensi terbaik yang sebenarnya Anda miliki.",
    strengths: "Anda gesit mempelajari hal baru, punya visi jauh ke depan, dan terus mendorong diri sendiri naik ke level berikutnya.",
    blindSpot: "Anda mudah gelisah dan sulit puas. Pencapaian hari ini cepat terasa kurang begitu ada standar baru yang lebih tinggi, dan Anda sering diam-diam membandingkan diri dengan orang lain.",
    keyQuestion: "Apakah Anda mengejar ini karena benar-benar ingin bertumbuh, atau karena takut tertinggal dari orang lain?",
  },
  significance_contribution: {
    name: "The Purpose-Driven Achiever™",
    desire: "Anda ingin mencapai sesuatu yang besar sekaligus memberi dampak nyata bagi kehidupan orang lain.",
    fear: "Sukses tapi terasa hampa, atau punya potensi besar yang tidak pernah benar-benar Anda pakai untuk sesuatu yang berarti.",
    strengths: "Anda memimpin dengan visi yang jelas, mendorong pencapaian yang punya makna, dan menginspirasi lewat hasil nyata, bukan sekadar kata-kata.",
    blindSpot: "Anda rentan merasa harus terus membuktikan bahwa diri Anda cukup berdampak. Pengakuan atas kontribusi Anda bisa jadi kebutuhan yang sulit benar-benar terpuaskan.",
    keyQuestion: "Apakah Anda melakukan ini demi dampaknya, atau demi diakui sudah berdampak?",
  },
  connection_growth: {
    name: "The Growth Catalyst™",
    desire: "Anda percaya pertumbuhan terbaik terjadi bersama orang lain, bukan sendirian.",
    fear: "Terjebak dalam hubungan yang stagnan, atau kehilangan kesempatan bertumbuh bersama orang-orang yang berarti bagi Anda.",
    strengths: "Anda secara alami membantu orang lain melihat potensi mereka sendiri, belajar lewat percakapan dan kolaborasi, dan membangun lingkungan yang saling mendorong maju.",
    blindSpot: "Anda bisa terlalu fokus membantu orang lain berkembang sampai lupa mengurus pertumbuhan Anda sendiri, dan mudah kecewa saat orang lain tidak seantusias Anda untuk berubah.",
    keyQuestion: "Apakah Anda mendorong orang ini bertumbuh karena mereka memang siap, atau karena Anda yang ingin mereka berubah?",
  },
  connection_contribution: {
    name: "The Compassionate Builder™",
    desire: "Anda ingin membangun hubungan yang benar-benar membuat hidup orang lain menjadi lebih baik.",
    fear: "Tidak bisa membantu saat dibutuhkan, atau menjalani hubungan yang terasa dangkal tanpa dampak nyata.",
    strengths: "Anda memberi dukungan dengan tulus, menjaga hubungan dalam jangka panjang, dan hadir sebagai sosok yang bisa diandalkan saat orang lain kesulitan.",
    blindSpot: "Anda gampang memberi lebih dari yang seharusnya, sulit bilang tidak, dan sering menomorduakan kebutuhan Anda sendiri demi membantu orang lain.",
    keyQuestion: "Apakah Anda membantu karena kepedulian yang sehat, atau karena merasa bertanggung jawab atas kebahagiaan semua orang?",
  },
  growth_contribution: {
    name: "The Transformational Builder™",
    desire: "Anda ingin terus berkembang dan memakai pertumbuhan itu untuk menciptakan perubahan yang berarti bagi orang lain.",
    fear: "Berhenti berkembang, atau punya potensi besar yang tidak pernah Anda pakai untuk sesuatu yang bernilai.",
    strengths: "Anda berpikir jauh ke depan, cepat menerapkan apa yang baru Anda pelajari, dan mendorong orang lain untuk ikut bertumbuh bersama Anda.",
    blindSpot: "Anda menaruh standar yang sangat tinggi pada progres, baik untuk diri sendiri maupun orang lain, dan bisa kecewa berat kalau perubahan yang diharapkan tidak terjadi secepat yang Anda bayangkan.",
    keyQuestion: "Apakah Anda mendorong perubahan ini karena benar-benar penting, atau karena tidak tahan melihat sesuatu tidak berkembang?",
  },
};

/**
 * Membentuk key konsisten dari 2 driver (urutan tidak penting) untuk
 * mengambil data di IMT_SYNERGY_MATRIX. Mengikuti urutan tetap
 * security→significance→connection→growth→contribution.
 */
function imtSynergyKey(driverA, driverB) {
  const fixedOrder = ["security", "significance", "connection", "growth", "contribution"];
  const pair = [driverA, driverB].sort((a, b) => fixedOrder.indexOf(a) - fixedOrder.indexOf(b));
  return `${pair[0]}_${pair[1]}`;
}

function imtSynergyFor(driverA, driverB) {
  return IMT_SYNERGY_MATRIX[imtSynergyKey(driverA, driverB)];
}

/* ============================================================
   Development Path™ per driver, dari dokumen "Development Path"
   resmi (5 dokumen per driver). Melengkapi IMT_DEV_STAGES (5 tahap
   universal berbasis skor DQ) dengan sesuatu yang spesifik untuk
   driver dominan peserta: rumus pertumbuhan, prioritas pengembangan,
   pertanyaan refleksi, dan satu tantangan konkret minggu ini.
   Ditulis ulang dengan suara sendiri, bukan kutipan KB.
   ============================================================ */
const IMT_DEV_PATH = {
  security: {
    purpose: "Mengembangkan Security bukan berarti menjadi lebih hati-hati atau lebih waspada. Tujuannya adalah membangun rasa aman dari dalam diri Anda sendiri, supaya Anda tetap tenang menghadapi perubahan tanpa harus mengendalikan semuanya.",
    formula: { parts: ["Stability", "Self-Trust", "Adaptive Courage"], result: "Adaptive Security™" },
    priorities: ["Adaptive Confidence", "Healthy Risk Taking", "Emotional Flexibility", "Decision Courage", "Self-Trust"],
    question: "Apakah rasa aman yang sedang Anda bangun ini benar-benar menguatkan Anda, atau justru mulai menahan Anda untuk bergerak?",
    challenge: "Minggu ini, coba ambil satu keputusan kecil tanpa menyusun rencana cadangan lebih dulu. Rasakan bagaimana rasanya bertindak dengan sedikit lebih banyak ruang untuk ketidakpastian.",
    signs: [
      "Anda mengambil keputusan lebih cepat, tanpa harus menunggu semua informasi lengkap.",
      "Perubahan rencana mendadak tidak lagi membuat Anda panik seperti dulu.",
      "Anda lebih percaya diri mengambil risiko kecil yang dulu terasa menakutkan.",
    ],
  },
  significance: {
    purpose: "Mengembangkan Significance bukan berarti menjadi kurang ambisius. Tujuannya adalah membangun rasa berharga dari dalam diri, sehingga pencapaian Anda lahir dari keinginan tulus, bukan dari kebutuhan untuk dibuktikan ke orang lain.",
    formula: { parts: ["Self-Worth", "Authentic Confidence", "Purpose-Driven Achievement"], result: "Authentic Significance™" },
    priorities: ["Internal Self-Worth", "Authentic Confidence", "Purpose-Driven Achievement", "Healthy Humility", "Self-Acceptance"],
    question: "Apakah Anda mengejar pencapaian ini karena benar-benar ingin, atau karena takut dianggap kurang berhasil?",
    challenge: "Minggu ini, coba akui satu pencapaian kecil ke diri sendiri tanpa menunggu orang lain memujinya lebih dulu.",
    signs: [
      "Anda tetap percaya diri meski sedang tidak dipuji atau divalidasi siapa pun.",
      "Kritik yang membangun tidak lagi terasa seperti serangan pribadi.",
      "Anda mulai lebih menikmati prosesnya, bukan cuma mengejar hasil akhir.",
    ],
  },
  connection: {
    purpose: "Mengembangkan Connection bukan berarti harus punya lebih banyak teman atau disukai semua orang. Tujuannya adalah membangun hubungan yang jujur dan bermakna, tanpa kehilangan diri sendiri di dalamnya.",
    formula: { parts: ["Self-Connection", "Healthy Boundaries", "Authentic Communication"], result: "Authentic Connection™" },
    priorities: ["Authentic Relationships", "Healthy Boundaries", "Emotional Independence", "Courageous Communication", "Self-Connection"],
    question: "Ketika Anda merasa dekat dengan seseorang, apakah itu karena Anda benar-benar jadi diri sendiri di situ, atau karena Anda berusaha keras supaya disukai?",
    challenge: "Minggu ini, coba sampaikan satu pendapat yang berbeda dari orang lain, meski itu berisiko sedikit menegangkan suasana.",
    signs: [
      "Anda lebih nyaman menjadi diri sendiri, bahkan di hubungan yang paling penting bagi Anda.",
      "Mengatakan 'tidak' terasa lebih ringan, tidak lagi dibayangi rasa bersalah.",
      "Hubungan Anda mulai terasa lebih jujur, bukan sekadar menjaga suasana tetap damai.",
    ],
  },
  growth: {
    purpose: "Mengembangkan Growth bukan berarti harus terus belajar tanpa henti atau mengejar setiap peluang baru. Tujuannya adalah bertumbuh dengan arah yang jelas, supaya kemajuan Anda benar-benar terasa, bukan sekadar terasa sibuk.",
    formula: { parts: ["Curiosity", "Focused Development", "Purposeful Learning"], result: "Purposeful Growth™" },
    priorities: ["Purposeful Growth", "Sustainable Learning", "Focused Development", "Contentment Awareness", "Wise Exploration"],
    question: "Ketika Anda mengejar sesuatu yang baru, apakah itu karena benar-benar ingin mendalaminya, atau karena bosan dengan yang lama?",
    challenge: "Minggu ini, coba selesaikan satu hal yang sudah Anda mulai sebelum beralih ke hal baru yang menarik perhatian Anda.",
    signs: [
      "Anda lebih fokus menyelesaikan apa yang sudah dimulai, alih-alih terus lompat ke hal baru.",
      "Kemajuan orang lain tidak lagi membuat Anda merasa tertinggal.",
      "Anda mulai menikmati prosesnya, bukan hanya memikirkan target berikutnya.",
    ],
  },
  contribution: {
    purpose: "Mengembangkan Contribution bukan berarti harus memberi lebih banyak atau mengorbankan diri lebih jauh. Tujuannya adalah menciptakan dampak yang benar-benar berkelanjutan, tanpa kehilangan keseimbangan hidup Anda sendiri.",
    formula: { parts: ["Purpose", "Healthy Responsibility", "Sustainable Service"], result: "Sustainable Contribution™" },
    priorities: ["Sustainable Contribution", "Healthy Responsibility", "Empowerment Mindset", "Balanced Purpose", "Self-Care Awareness"],
    question: "Apakah Anda membantu kali ini karena punya ruang untuk itu, atau karena merasa bersalah kalau menolak?",
    challenge: "Minggu ini, coba tolak satu permintaan bantuan yang sebenarnya di luar kapasitas Anda, dan perhatikan bagaimana rasanya.",
    signs: [
      "Anda bisa berkata 'tidak' tanpa rasa bersalah ketika kapasitas Anda memang terbatas.",
      "Anda lebih fokus pada dampak yang benar-benar berarti, bukan sekadar jumlah hal yang dikerjakan.",
      "Anda tetap punya energi untuk terus berkontribusi dalam jangka panjang, tidak cepat kehabisan tenaga.",
    ],
  },
};

/* ============================================================
   Sub Composite™: 25 kualitas di balik 5 Driver (5 per driver) dari
   dokumen "IMT Gold Standard Sub Composite" & "Sub Composite-Micro"
   (Behavioral Indicators). Di KB resmi, tiap sub composite idealnya
   punya asesmen 10-soal sendiri (250 soal total), terlalu panjang
   untuk tes ~13 menit yang jadi komitmen produk ini.

   Kompromi yang dipakai di sini (bukan mengarang, bukan juga 250
   soal): 8 soal inti per driver yang SUDAH ADA ditandai (subComposite
   pada IMT_QUESTIONS) ke salah satu dari 5 sub composite driver itu:
   3 sub composite kebagian 2 soal, 2 sub composite kebagian 1 soal
   (urutan tetap: entri ke-0/1/2 di array bawah = 2 soal, entri ke-3/4
   = 1 soal). Skor dihitung nyata dari jawaban asli (lihat
   imtSubCompositeScores()), bukan skor 5 Driver utama yang dipecah,
   dan bukan angka rekaan. Yang kebagian 1 soal ditandai `reliability:
   "indicative"` supaya UI bisa memberi catatan kejujuran (skor dari
   1 pernyataan itu indikatif, bukan setepat yang 2 pernyataan).

   `blurb` dipakai di box "spotlight" (1 sub composite disorot di
   report utama). `tagline` adalah versi singkat untuk baris skor di
   halaman Overview.
   ============================================================ */
const IMT_SUB_COMPOSITE = {
  security: [
    { key: "stability", name: "Stability", tagline: "Menjaga ritme hidup tetap teratur dan terkendali", blurb: "Anda punya kemampuan menjaga ritme hidup tetap teratur, bahkan ketika semuanya terasa berantakan di sekitar Anda." },
    { key: "certainty", name: "Certainty", tagline: "Mengumpulkan kejelasan sebelum melangkah", blurb: "Anda cenderung mengumpulkan cukup kejelasan sebelum melangkah, bukan supaya sempurna, tapi supaya yakin." },
    { key: "trustworthiness", name: "Trustworthiness", tagline: "Selaras antara kata dan tindakan", blurb: "Kata-kata dan tindakan Anda cenderung selaras, dan itulah yang membuat orang lain merasa aman mempercayakan sesuatu kepada Anda." },
    { key: "authenticity", name: "Authenticity", tagline: "Nyaman menjadi diri sendiri", blurb: "Anda tidak mudah goyah oleh tekanan untuk jadi orang lain hanya demi diterima.", reliability: "indicative" },
    { key: "resilience", name: "Resilience", tagline: "Bangkit kembali setelah kesulitan", blurb: "Anda punya kapasitas untuk bangkit lagi setelah situasi yang mengguncang, bukan cuma sekadar bertahan.", reliability: "indicative" },
  ],
  significance: [
    { key: "recognition", name: "Recognition", tagline: "Memberi usaha terbaik, diakui atau tidak", blurb: "Anda memberi usaha terbaik bahkan untuk hal-hal kecil yang mungkin tidak semua orang perhatikan." },
    { key: "achievement", name: "Achievement", tagline: "Menetapkan target dan mengejarnya sampai selesai", blurb: "Anda cenderung menetapkan target yang jelas dan benar-benar mengejarnya sampai selesai." },
    { key: "self_worth", name: "Self-Worth", tagline: "Menghargai diri terlepas dari hasil", blurb: "Ada penghargaan terhadap diri sendiri dalam diri Anda yang tidak sepenuhnya bergantung pada validasi orang lain." },
    { key: "competence", name: "Competence", tagline: "Terus mengasah kemampuan diri", blurb: "Anda terus mengasah kemampuan, bukan supaya terlihat hebat, tapi supaya benar-benar layak dipercaya.", reliability: "indicative" },
    { key: "confidence", name: "Confidence", tagline: "Berani mencoba meski hasil belum pasti", blurb: "Anda berani mencoba hal baru meski hasilnya belum pasti.", reliability: "indicative" },
  ],
  connection: [
    { key: "belonging", name: "Belonging", tagline: "Merasa jadi bagian dari sesuatu yang lebih besar", blurb: "Anda punya kebutuhan yang sehat untuk merasa jadi bagian dari sesuatu yang lebih besar dari diri sendiri." },
    { key: "trust", name: "Trust", tagline: "Memberi kepercayaan secara proporsional", blurb: "Anda memberi kepercayaan secara proporsional, tidak buta, tapi juga tidak menutup diri." },
    { key: "empathy", name: "Empathy", tagline: "Memperhatikan apa yang dirasakan orang lain", blurb: "Anda cenderung memperhatikan apa yang dirasakan orang lain, bukan cuma apa yang mereka katakan." },
    { key: "intimacy", name: "Intimacy", tagline: "Membangun kedekatan yang bermakna", blurb: "Anda mampu membangun kedekatan yang cukup dalam, bukan sekadar hubungan di permukaan.", reliability: "indicative" },
    { key: "acceptance", name: "Acceptance", tagline: "Terbuka menerima perbedaan orang lain", blurb: "Anda cukup terbuka menerima orang lain apa adanya, meski berbeda dari cara Anda memandang sesuatu.", reliability: "indicative" },
  ],
  growth: [
    { key: "curiosity", name: "Curiosity", tagline: "Rasa ingin tahu yang muncul lebih dulu", blurb: "Rasa ingin tahu Anda sering muncul lebih dulu, sebelum sempat menilai apakah sesuatu itu berguna atau tidak." },
    { key: "learning", name: "Learning", tagline: "Mencari cara untuk terus belajar", blurb: "Anda punya kebiasaan mencari cara untuk terus belajar, bukan cuma menunggu ilmu itu datang sendiri." },
    { key: "adaptability", name: "Adaptability", tagline: "Cepat menyesuaikan diri saat rencana berubah", blurb: "Anda cukup cepat menyesuaikan diri ketika keadaan berubah dari rencana awal." },
    { key: "mastery", name: "Mastery", tagline: "Standar tinggi terhadap kualitas hasil kerja", blurb: "Anda punya standar pribadi yang cukup tinggi terhadap kualitas hasil kerja Anda sendiri.", reliability: "indicative" },
    { key: "self_expansion", name: "Self-Expansion", tagline: "Keluar dari zona nyaman untuk berkembang", blurb: "Anda tertarik keluar dari zona nyaman meski itu berarti menghadapi ketidaknyamanan sesaat.", reliability: "indicative" },
  ],
  contribution: [
    { key: "service", name: "Service", tagline: "Menawarkan bantuan sebelum diminta", blurb: "Anda cenderung menawarkan bantuan bahkan sebelum diminta, ketika melihat seseorang membutuhkannya." },
    { key: "value_creation", name: "Value Creation", tagline: "Menciptakan sesuatu yang benar-benar terpakai", blurb: "Anda lebih tertarik menciptakan sesuatu yang benar-benar terpakai, bukan cuma terlihat bagus." },
    { key: "influence", name: "Influence", tagline: "Menggerakkan orang lain lewat sikap", blurb: "Cara Anda bersikap punya kecenderungan menggerakkan orang lain untuk ikut bertindak." },
    { key: "stewardship", name: "Stewardship", tagline: "Memikirkan keberlanjutan, bukan cuma hasil sekarang", blurb: "Anda memikirkan keberlanjutan sesuatu, bukan cuma hasil yang terlihat sekarang.", reliability: "indicative" },
    { key: "legacy", name: "Legacy", tagline: "Mendorong sesuatu yang tetap bernilai jangka panjang", blurb: "Anda punya dorongan untuk meninggalkan sesuatu yang tetap bernilai, bahkan setelah Anda tidak lagi terlibat langsung.", reliability: "indicative" },
  ],
};

/**
 * Memilih 1 dari 5 sub composite milik driver dominan untuk disorot,
 * berdasarkan posisi driver #2 peserta dalam urutan tetap 5 driver,
 * jadi pilihannya konsisten untuk kombinasi data yang sama, tapi
 * bervariasi antar peserta sesuai driver #2 mereka (bukan acak).
 */
function imtSubCompositeSpotlight(topDriver, secondDriver) {
  const fixedOrder = ["security", "significance", "connection", "growth", "contribution"];
  const idx = fixedOrder.indexOf(secondDriver) % 5;
  const list = IMT_SUB_COMPOSITE[topDriver];
  return list[idx];
}

/**
 * answers: {1: 5, 2: 7, ...} (1-7 Likert) -> skor nyata 0-100 per sub
 * composite, dihitung dari soal "core" yang ditandai subComposite di
 * IMT_QUESTIONS (1 atau 2 soal, lihat catatan di atas IMT_SUB_COMPOSITE).
 * Formula sama persis dengan imtScore(): (raw - n) / (6n) * 100.
 * Mengembalikan { security: [{key,name,tagline,score,itemCount,reliability}, ...5], ... }
 * dengan urutan mengikuti IMT_SUB_COMPOSITE.
 */
function imtSubCompositeScores(answers) {
  const res = {};
  Object.keys(IMT_SUB_COMPOSITE).forEach(driver => {
    res[driver] = IMT_SUB_COMPOSITE[driver].map(sc => {
      const items = IMT_QUESTIONS.filter(q => (q.type === "core" || q.type === "reverse core") && q.driver === driver && q.subComposite === sc.key);
      const validItems = items.filter(q => Number(answers[q.id]) > 0);
      const n = validItems.length || 1;
      const raw = validItems.reduce((sum, q) => {
        let val = Number(answers[q.id]);
        if (q.type === "reverse core") val = 8 - val;
        return sum + val;
      }, 0);
      const score = Math.round(((raw - n) / (6 * n)) * 100);
      return { ...sc, score: Math.max(0, Math.min(100, score)), itemCount: items.length, reliability: sc.reliability || "standard" };
    });
  });
  return res;
}

const IMT_BANDS = [
  { key: "low", min: 0, max: 25, label: "Sangat Rendah" },
  { key: "mid", min: 26, max: 50, label: "Rendah" },
  { key: "high", min: 51, max: 75, label: "Sedang" },
  { key: "vhigh", min: 76, max: 100, label: "Tinggi" },
];

function imtBandFor(score) {
  return IMT_BANDS.find(b => score >= b.min && score <= b.max) || IMT_BANDS[IMT_BANDS.length - 1];
}

/**
 * Mengacak urutan 50 soal (interleave antar-driver) supaya pola blok per-driver
 * tidak mudah ditebak peserta. Aturan: tidak boleh ada 2 soal berturut-turut
 * dari driver yang sama. Dipanggil sekali di awal setiap sesi tes.
 * Mengembalikan array IMT_QUESTIONS dalam urutan acak baru (id soal tidak berubah).
 */
function imtShuffledQuestions() {
  // Kelompokkan & acak isi tiap driver dulu (modul "general" di luar sini —
  // ditempatkan terpisah di akhir tes lewat imtValidityModuleQuestions()).
  const byDriver = {};
  IMT_QUESTIONS.filter(q => q.driver !== "general").forEach(q => { (byDriver[q.driver] ||= []).push(q); });
  Object.values(byDriver).forEach(list => {
    for (let i = list.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [list[i], list[j]] = [list[j], list[i]];
    }
  });

  // Greedy round-robin: setiap langkah, pilih acak dari driver dengan sisa soal
  // terbanyak (di antara yang bukan driver terakhir dipakai), menjamin tidak
  // ada 2 soal driver yang sama berurutan selama jumlah tiap driver seimbang.
  const drivers = Object.keys(byDriver);
  const total = drivers.reduce((a, d) => a + byDriver[d].length, 0);
  const result = [];
  let lastDriver = null;
  while (result.length < total) {
    const candidates = drivers.filter(d => byDriver[d].length > 0 && d !== lastDriver);
    const pool = candidates.length > 0 ? candidates : drivers.filter(d => byDriver[d].length > 0);
    const maxLeft = Math.max(...pool.map(d => byDriver[d].length));
    const topPool = pool.filter(d => byDriver[d].length === maxLeft);
    const pick = topPool[Math.floor(Math.random() * topPool.length)];
    result.push(byDriver[pick].pop());
    lastDriver = pick;
  }
  return result;
}

/**
 * Modul validitas tambahan (id 51-56, driver "general"), diacak sendiri
 * dan ditempatkan setelah 50 soal utama, bukan disisipkan di tengah.
 */
function imtValidityModuleQuestions() {
  const mod = IMT_QUESTIONS.filter(q => q.driver === "general");
  for (let i = mod.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [mod[i], mod[j]] = [mod[j], mod[i]];
  }
  return mod;
}

/**
 * answers: {1: 5, 2: 7, ...} (1-7 Likert) -> returns { security: 63, ... }
 * Hanya soal type "core" (8 per driver) yang dihitung ke skor Driver.
 * Raw per driver: min 8 (semua 1), max 56 (semua 7) -> dinormalisasi ke 0-100.
 */
function imtScore(answers) {
  const raw = { security: 0, significance: 0, connection: 0, growth: 0, contribution: 0 };
  const counts = { security: 0, significance: 0, connection: 0, growth: 0, contribution: 0 };
  
  IMT_QUESTIONS.filter(q => q.type === "core" || q.type === "reverse core").forEach(q => {
    let val = Number(answers[q.id] || 0);
    if (val > 0) {
      if (q.type === "reverse core") val = 8 - val;
      raw[q.driver] += val;
      counts[q.driver] += 1;
    }
  });
  
  const scores = {};
  Object.keys(raw).forEach(d => {
    const count = counts[d] || 8;
    const minPossible = count * 1;
    const range = count * 6;
    scores[d] = Math.round(((raw[d] - minPossible) / range) * 100);
  });
  return scores;
}

function imtArchetype(scores) {
  let top = null, topScore = -Infinity;
  Object.entries(scores).forEach(([d, s]) => { if (s > topScore) { topScore = s; top = d; } });
  return top;
}

/* ============================================================
   BAB 5: The Five Dimensions of Driver Intelligence™ (DI)
   Sumber: Theoretical Foundation V1, Bab 5.4
   ============================================================ */
const IMT_DI_DIMENSIONS = [
  {
    key: "awareness", label: "AWARENESS", name: "Driver Awareness™",
    desc: "Titik awal dari segalanya, menyadari driver mana yang paling sering mengambil alih pikiran dan tindakan Anda.",
  },
  {
    key: "insight", label: "INSIGHT", name: "Driver Insight™",
    desc: "Menghubungkan titik antara apa yang Anda rasakan, pikirkan, dan akhirnya putuskan.",
  },
  {
    key: "regulation", label: "REGULATION", name: "Driver Regulation™",
    desc: "Menjaga driver Anda tetap bekerja untuk Anda, bukan malah mengambil alih saat tekanan datang.",
  },
  {
    key: "development", label: "DEVELOPMENT", name: "Driver Development™",
    desc: "Mengubah kesadaran menjadi kebiasaan yang sengaja dibangun, bukan dibiarkan berjalan begitu saja.",
  },
  {
    key: "transformation", label: "TRANSFORMATION", name: "Driver Transformation™",
    desc: "Titik di mana driver bukan lagi sekadar dorongan, tapi alat yang benar-benar Anda kendalikan.",
  },
];

/* ============================================================
   Interpretasi personal per dimensi DI, berdasarkan skor peserta
   (bukan definisi kamus/KB yang statis untuk semua orang). Setiap
   dimensi punya 4 versi teks sesuai band skor (low/mid/high/vhigh,
   selaras dengan IMT_BANDS), dengan {driver} diganti nama Driver
   dominan peserta saat dirender. Tujuannya agar laporan terasa
   seperti hasil analisis personal, bukan salinan teori.
   ============================================================ */
const IMT_DI_NARRATIVES = {
  awareness: {
    vhigh: "Anda memiliki kesadaran yang sangat kuat terhadap apa yang menggerakkan Anda. {driver} bukan sekadar kecenderungan. Ia menjadi sumber di balik hampir setiap keputusan dan tindakan Anda, dan Anda cenderung menolak melakukan sesuatu yang bertentangan dengannya, bahkan ketika situasi menekan Anda untuk berkompromi.",
    high: "Anda cukup mengenali bahwa {driver} adalah salah satu penggerak utama dalam diri Anda. Di saat-saat penting, kesadaran ini muncul dan ikut menentukan arah keputusan Anda, meski belum selalu Anda sadari di setiap momen kecil.",
    mid: "Kesadaran Anda terhadap apa yang sebenarnya menggerakkan diri masih terus berkembang. Anda kadang memahami alasan di balik pilihan Anda, namun di lain waktu bertindak lebih karena kebiasaan atau tuntutan situasi ketimbang dorongan batin yang benar-benar disadari.",
    low: "Anda belum terlalu terbiasa mengenali apa yang sebenarnya menggerakkan tindakan Anda sehari-hari. Keputusan sering diambil secara reaktif, mengikuti situasi yang ada, tanpa banyak jeda untuk bertanya driver apa yang sedang bekerja di baliknya.",
  },
  insight: {
    vhigh: "Anda memiliki pemahaman yang tajam tentang mengapa Anda bereaksi seperti itu dalam berbagai situasi. Anda mampu menghubungkan titik antara emosi yang muncul, pikiran yang mengikutinya, dan keputusan yang akhirnya Anda ambil, sehingga pola diri Anda terasa masuk akal, bukan misterius, bahkan bagi Anda sendiri.",
    high: "Anda cukup mampu melihat pola di balik reaksi dan keputusan Anda, terutama setelah momen tersebut berlalu dan Anda punya waktu untuk merenung. Anda mulai bisa menjelaskan 'mengapa', bukan sekadar 'apa', dari perilaku Anda.",
    mid: "Anda kadang menyadari ada pola tertentu dalam cara Anda bereaksi, namun belum selalu bisa menjelaskan dari mana pola itu berasal. Hubungan antara apa yang Anda rasakan dan bagaimana Anda bertindak masih terasa samar, bahkan bagi Anda sendiri.",
    low: "Anda cenderung mengalami emosi dan mengambil keputusan tanpa banyak menelusuri sebabnya. Pertanyaan 'mengapa saya bereaksi seperti ini?' bukan sesuatu yang biasa Anda tanyakan pada diri sendiri.",
  },
  regulation: {
    vhigh: "Anda cukup terampil menjaga {driver} tetap bekerja secara sehat, bahkan ketika berada di bawah tekanan. Anda mampu mengenali tanda-tanda awal ketika driver ini mulai bergeser ke sisi yang kurang sehat, dan menyesuaikan respons Anda sebelum hal itu memengaruhi keputusan besar.",
    high: "Anda cukup mampu mengelola {driver} dalam situasi yang menekan, meski sesekali masih terbawa oleh versi kurang sehatnya saat tekanan cukup besar. Secara umum, Anda bisa menarik diri dan menstabilkan reaksi Anda setelah momen awal berlalu.",
    mid: "Ketika berada di bawah tekanan, {driver} dalam diri Anda cenderung muncul dalam bentuk yang belum sepenuhnya terkendali. Anda menyadari perubahan ini terjadi, namun belum selalu punya cara yang konsisten untuk menanganinya saat itu juga.",
    low: "Anda cenderung cukup mudah terbawa oleh sisi kurang sehat dari {driver} ketika berada di bawah tekanan, dan butuh waktu lebih lama untuk kembali stabil. Pola ini bisa memengaruhi keputusan yang Anda ambil dalam situasi yang penuh tuntutan.",
  },
  development: {
    vhigh: "Anda secara aktif membangun kebiasaan yang memperkuat sisi positif dari {driver}, dan terus mencari cara untuk memperluas kapasitas Anda dari waktu ke waktu. Pertumbuhan bukan sesuatu yang Anda tunggu terjadi, tapi sesuatu yang Anda upayakan dengan sengaja.",
    high: "Anda cukup terbuka untuk mengembangkan diri lebih jauh, dan mulai membangun kebiasaan yang mendukung sisi positif dari {driver}. Prosesnya belum selalu konsisten, namun arah perkembangan Anda cukup jelas.",
    mid: "Anda punya keinginan untuk berkembang, tapi belum selalu menerjemahkannya menjadi kebiasaan yang konsisten. Pertumbuhan cenderung terjadi ketika situasi 'memaksa', bukan karena inisiatif yang Anda bangun sendiri.",
    low: "Fokus Anda saat ini lebih banyak tertuju pada menjalani hari daripada secara sengaja mengembangkan kapasitas dari {driver}. Ini bukan kekurangan, hanya ruang yang, jika Anda pilih untuk mengisinya, bisa membuka banyak potensi baru.",
  },
  transformation: {
    vhigh: "Anda sudah berada di titik di mana {driver} tidak lagi sekadar dorongan yang Anda ikuti, tapi alat yang Anda gunakan secara sadar untuk menciptakan perubahan yang bermakna, baik bagi diri Anda maupun orang di sekitar Anda.",
    high: "Anda mulai menggunakan {driver} secara lebih sadar sebagai kekuatan, bukan sekadar reaksi otomatis. Ada momen-momen di mana Anda benar-benar mengarahkan driver ini untuk menciptakan hasil yang Anda inginkan.",
    mid: "Anda berada di tahap awal mengubah {driver} dari sekadar dorongan menjadi kekuatan yang bisa diarahkan. Prosesnya masih berjalan, dan setiap kesadaran baru membawa Anda selangkah lebih dekat.",
    low: "Saat ini {driver} masih bekerja lebih banyak di 'balik layar', memengaruhi Anda tanpa banyak Anda sadari atau arahkan. Ruang terbesar untuk berkembang ada di sini: mengubah dorongan ini menjadi kekuatan yang benar-benar Anda kendalikan.",
  },
};

/**
 * Mengembalikan teks interpretasi personal untuk satu dimensi DI,
 * dipilih berdasarkan band skor peserta (bukan teks tetap dari KB),
 * dengan nama Driver dominan disisipkan ke dalam kalimat.
 */
function imtDiInterpret(key, score, driverName) {
  const band = imtBandFor(Math.max(0, Math.min(100, score)));
  const template = (IMT_DI_NARRATIVES[key] && IMT_DI_NARRATIVES[key][band.key]) || "";
  return template.replace(/\{driver\}/g, driverName);
}

/* ============================================================
   BAB 6: Driver Dynamics™ (Healthy / Activated / Stress / Shadow /
   Growth State + Core Development Challenge)
   Sumber: dokumen resmi "Driver Dynamix" (5 dokumen per driver).
   Ditulis ulang dengan suara sendiri ("Anda", bukan "Mereka") dan
   bukan kutipan mentah dari KB, mengikuti skill imt-warm-reporting.
   Setiap driver punya 5 kondisi + satu "pelajaran hidup" terbesarnya.
   ============================================================ */
const IMT_DRIVER_DYNAMICS = {
  security: {
    healthy: { desc: "Ini versi Security yang paling sehat, saat rasa aman menjadi fondasi Anda melangkah, bukan alasan untuk berhenti.", points: [
      "Anda tetap tenang menghadapi ketidakpastian, tidak mudah panik.",
      "Anda bisa merencanakan ke depan tanpa harus tahu segalanya lebih dulu.",
      "Orang lain merasa bisa mengandalkan Anda karena Anda konsisten.",
      "Anda punya fondasi emosional yang cukup kuat untuk menghadapi tekanan.",
    ]},
    activated: { desc: "Kondisi ini menyala saat Anda merasa perlu memastikan semuanya berjalan baik sebelum melangkah lebih jauh.", trigger: "Biasanya muncul saat Anda mengambil keputusan penting, memulai sesuatu yang baru, atau menanggung tanggung jawab besar.", points: [
      "Anda mulai mengumpulkan informasi dan menyusun rencana.",
      "Anda memikirkan risiko dan menyiapkan opsi cadangan.",
      "Anda memastikan semuanya sudah siap sebelum benar-benar melangkah.",
    ]},
    stress: { desc: "Saat rasa aman mulai terasa terancam, pola-pola berikut biasanya muncul dalam diri Anda.", points: [
      "Anda mulai overthinking dan sulit mengambil keputusan.",
      "Anda terus mencari kepastian tambahan sebelum bertindak.",
      "Anda cenderung menunda karena belum merasa cukup yakin.",
      "Fokus Anda bergeser dari peluang ke kemungkinan ancaman.",
    ]},
    shadow: { desc: "Ini versi berlebihan Security, saat kebutuhan akan kepastian berubah jadi usaha mengendalikan segalanya.", points: [
      "Anda menjadi sangat perfeksionis dan kaku terhadap perubahan.",
      "Anda sulit mempercayakan sesuatu ke orang lain karena ingin mengurus semuanya sendiri.",
      "Anda menolak risiko meski sebenarnya diperlukan.",
      "Semakin Anda berusaha mengendalikan semuanya, semakin besar kecemasan yang justru muncul.",
    ]},
    growth: { desc: "Bentuk paling matang dari Security adalah tetap melangkah meski kepastian penuh tidak tersedia.", points: [
      "Anda tetap tenang meski situasinya belum sepenuhnya jelas.",
      "Anda berani mengambil risiko yang sudah diperhitungkan.",
      "Anda percaya pada kemampuan diri sendiri untuk beradaptasi.",
      "Anda mampu menularkan rasa aman itu ke orang-orang di sekitar Anda.",
    ]},
    challenge: { title: "Belajar Mempercayai Diri Sendiri", lesson: "Inti tantangan Anda bukan mencari lebih banyak kepastian, tapi membangun kepercayaan pada diri sendiri untuk menghadapi apa pun yang belum pasti.", points: [
      "Tidak semua risiko bisa dihindari.",
      "Tidak semua jawaban bisa diketahui sejak awal.",
      "Ketidakpastian adalah bagian yang wajar dari hidup.",
      "Keberanian dan rasa aman bisa berjalan berdampingan.",
    ], question: "Kalau dipikir lagi, rencana cadangan yang sedang Anda susun ini, benar-benar dibutuhkan, atau sekadar supaya Anda merasa lebih tenang?" },
  },
  significance: {
    healthy: { desc: "Ini versi Significance yang paling sehat, saat Anda percaya pada nilai diri tanpa harus terus membuktikannya.", points: [
      "Anda percaya diri terhadap kemampuan yang Anda miliki.",
      "Anda punya tujuan yang jelas dan berani mengambil tanggung jawab.",
      "Anda terdorong untuk terus berkembang dan berprestasi.",
      "Nilai diri Anda tidak sepenuhnya bergantung pada pengakuan orang lain.",
    ]},
    activated: { desc: "Kondisi ini menyala saat Anda ingin mencapai sesuatu yang benar-benar bernilai.", trigger: "Biasanya muncul saat Anda menetapkan target baru, menghadapi tantangan besar, atau membangun reputasi profesional.", points: [
      "Anda menetapkan standar yang tinggi untuk diri sendiri.",
      "Anda bekerja dengan fokus penuh dan mengambil inisiatif.",
      "Anda berusaha menunjukkan kemampuan terbaik Anda.",
    ]},
    stress: { desc: "Saat nilai diri Anda mulai terasa dipertanyakan, pola-pola berikut biasanya muncul.", points: [
      "Anda mulai membandingkan diri dengan orang lain.",
      "Anda jadi lebih sensitif terhadap kritik.",
      "Anda takut terlihat tidak kompeten di depan orang lain.",
      "Energi Anda lebih banyak terpakai menjaga citra daripada benar-benar berkembang.",
    ]},
    shadow: { desc: "Ini versi berlebihan Significance, saat kebutuhan untuk diakui berubah jadi dorongan membuktikan diri tanpa henti.", points: [
      "Anda menjadi sangat haus pengakuan.",
      "Anda kompetitif secara berlebihan, bahkan di hal-hal kecil.",
      "Anda sulit menerima kelemahan diri sendiri.",
      "Semakin banyak pengakuan yang Anda dapat, semakin sulit Anda merasa benar-benar cukup.",
    ]},
    growth: { desc: "Bentuk paling matang dari Significance adalah menyadari bahwa nilai diri Anda tidak bergantung pada pencapaian.", points: [
      "Anda percaya diri tanpa harus terus membuktikan diri.",
      "Anda mampu menerima kegagalan maupun keberhasilan dengan tenang.",
      "Anda lebih menghargai prosesnya, bukan cuma hasil akhirnya.",
      "Anda memakai kemampuan Anda untuk menginspirasi, bukan sekadar diakui.",
    ]},
    challenge: { title: "Belajar Menghargai Nilai Diri", lesson: "Inti tantangan Anda bukan berhenti mengejar pencapaian, tapi berhenti menjadikan pencapaian sebagai satu-satunya bukti bahwa Anda berharga.", points: [
      "Kegagalan tidak mengurangi nilai diri Anda.",
      "Kritik tidak selalu berarti penolakan.",
      "Tidak semua orang harus mengagumi Anda.",
      "Harga diri Anda bukan sama dengan daftar pencapaian Anda.",
    ], question: "Coba jujur ke diri sendiri. Pencapaian yang sedang Anda kejar ini murni karena Anda menginginkannya, atau karena takut dianggap kurang?" },
  },
  connection: {
    healthy: { desc: "Ini versi Connection yang paling sehat, saat Anda terhubung dengan orang lain tanpa kehilangan diri sendiri.", points: [
      "Anda mudah membangun kepercayaan dengan orang lain.",
      "Anda menunjukkan empati yang tulus, bukan basa-basi.",
      "Anda menjaga hubungan yang penting bagi Anda dengan konsisten.",
      "Anda tetap punya identitas sendiri di dalam hubungan apa pun.",
    ]},
    activated: { desc: "Kondisi ini menyala saat Anda ingin membangun kedekatan yang lebih bermakna dengan seseorang.", trigger: "Biasanya muncul saat Anda memasuki lingkungan baru, membangun tim, atau ada seseorang yang butuh dukungan Anda.", points: [
      "Anda jadi lebih banyak mendengarkan.",
      "Anda berusaha memahami sudut pandang orang lain.",
      "Anda menunjukkan perhatian lewat komunikasi yang hangat.",
    ]},
    stress: { desc: "Saat rasa diterima mulai terasa terancam, pola-pola berikut biasanya muncul.", points: [
      "Anda mulai terlalu memikirkan pendapat orang lain tentang Anda.",
      "Anda khawatir ditolak atau mengecewakan seseorang.",
      "Anda jadi sulit mengungkapkan ketidaksetujuan.",
      "Energi Anda lebih banyak terpakai menghindari penolakan daripada membangun hubungan yang tulus.",
    ]},
    shadow: { desc: "Ini versi berlebihan Connection, saat keinginan diterima berubah jadi kebiasaan menyenangkan semua orang.", points: [
      "Anda jadi terlalu sering berusaha menyenangkan orang lain.",
      "Anda sulit mengatakan tidak, bahkan saat sebenarnya ingin.",
      "Anda menghindari konflik secara berlebihan.",
      "Anda mengorbankan kebutuhan sendiri demi tetap diterima.",
    ]},
    growth: { desc: "Bentuk paling matang dari Connection adalah tetap terhubung meski ada perbedaan pendapat.", points: [
      "Anda membangun hubungan yang jujur, bukan sekadar nyaman.",
      "Anda berani menyampaikan kebutuhan dan pendapat Anda.",
      "Anda tetap terhubung meski ada perbedaan pendapat.",
      "Anda membangun hubungan atas dasar keaslian, bukan ketergantungan.",
    ]},
    challenge: { title: "Belajar Terhubung Secara Autentik", lesson: "Inti tantangan Anda bukan menjaga semua orang tetap senang, tapi berani menjadi diri sendiri meski itu berisiko tidak disukai.", points: [
      "Tidak semua orang harus menyukai Anda.",
      "Konflik tidak selalu merusak hubungan.",
      "Kejujuran lebih penting daripada sekadar disetujui.",
      "Hubungan yang sehat butuh batasan yang jelas.",
    ], question: "Hubungan yang sedang Anda jaga erat-erat itu, apakah memang sehat, atau Anda hanya takut kehilangan rasa diterima?" },
  },
  growth: {
    healthy: { desc: "Ini versi Growth yang paling sehat, saat Anda berkembang karena percaya selalu ada ruang jadi lebih baik.", points: [
      "Anda terbuka terhadap ide-ide baru.",
      "Anda menikmati proses belajar itu sendiri, bukan cuma hasilnya.",
      "Anda mudah beradaptasi ketika keadaan berubah.",
      "Anda percaya selalu ada ruang untuk menjadi lebih baik.",
    ]},
    activated: { desc: "Kondisi ini menyala saat Anda menghadapi sesuatu yang baru dan ingin mempelajarinya.", trigger: "Biasanya muncul saat Anda menghadapi tantangan baru, mempelajari keterampilan baru, atau menemukan peluang baru.", points: [
      "Anda jadi banyak bertanya dan mencari wawasan baru.",
      "Anda mengeksplorasi berbagai pilihan sebelum memutuskan.",
      "Anda mencoba pendekatan yang berbeda dari biasanya.",
    ]},
    stress: { desc: "Saat kemajuan terasa terlalu lambat, pola-pola berikut biasanya muncul dalam diri Anda.", points: [
      "Anda jadi gelisah ketika tidak melihat kemajuan.",
      "Anda sulit menikmati pencapaian yang sudah Anda raih.",
      "Anda terus mencari hal baru tanpa menyelesaikan yang lama.",
      "Fokus Anda bergeser dari belajar ke kecemasan soal ketinggalan.",
    ]},
    shadow: { desc: "Ini versi berlebihan Growth, saat rasa ingin berkembang berubah jadi ketidakpuasan yang terus-menerus.", points: [
      "Anda tidak pernah merasa cukup dengan pencapaian Anda.",
      "Anda selalu mengejar hal berikutnya sebelum yang sekarang selesai.",
      "Anda mudah bosan terhadap rutinitas.",
      "Anda mengabaikan stabilitas demi terus mencari pengalaman baru.",
    ]},
    growth: { desc: "Bentuk paling matang dari Growth adalah berkembang dengan sabar, bukan terburu-buru.", points: [
      "Anda menikmati proses belajar sekaligus hasilnya.",
      "Anda menerima bahwa pertumbuhan butuh waktu.",
      "Anda mampu menyeimbangkan eksplorasi dengan stabilitas.",
      "Anda membantu orang lain berkembang lewat pengalaman Anda.",
    ]},
    challenge: { title: "Belajar Menikmati Proses Bertumbuh", lesson: "Inti tantangan Anda bukan bergerak lebih cepat, tapi belajar menghargai kemajuan yang sudah Anda capai sejauh ini.", points: [
      "Tidak semua peluang harus Anda ambil.",
      "Tidak semua perubahan berarti kemajuan.",
      "Pertumbuhan membutuhkan kesabaran.",
      "Istirahat juga bagian dari berkembang.",
    ], question: "Sebelum mengejar hal baru berikutnya, tanyakan pada diri sendiri: ini benar-benar penting bagi Anda, atau Anda cuma tidak tahan melihat diri sendiri diam di tempat?" },
  },
  contribution: {
    healthy: { desc: "Ini versi Contribution yang paling sehat, saat Anda membantu karena itu terasa alami, bukan kewajiban.", points: [
      "Anda punya rasa tanggung jawab yang sehat terhadap sekitar Anda.",
      "Anda memikirkan dampak jangka panjang dari tindakan Anda.",
      "Anda senang membantu dan memberdayakan orang lain.",
      "Anda membantu bukan karena merasa harus, tapi karena itu terasa alami bagi Anda.",
    ]},
    activated: { desc: "Kondisi ini menyala saat Anda melihat peluang untuk memberi dampak yang lebih besar.", trigger: "Biasanya muncul saat Anda menemukan masalah yang perlu diselesaikan, memimpin sesuatu yang bermakna, atau melihat orang lain butuh bantuan.", points: [
      "Anda mencari cara untuk membantu.",
      "Anda mengambil tanggung jawab tambahan dengan sukarela.",
      "Anda menghubungkan tindakan Anda dengan tujuan yang lebih besar.",
    ]},
    stress: { desc: "Saat dampak yang Anda beri terasa kurang berarti, pola-pola berikut biasanya muncul.", points: [
      "Anda mulai meragukan manfaat dari apa yang sudah Anda berikan.",
      "Anda merasa belum cukup berkontribusi.",
      "Anda sulit merasa puas terhadap dampak yang sudah tercipta.",
      "Anda merasa bersalah ketika mendahulukan kebutuhan pribadi.",
    ]},
    shadow: { desc: "Ini versi berlebihan Contribution, saat keinginan membantu berubah jadi pengorbanan diri tanpa batas.", points: [
      "Anda mengorbankan diri secara berlebihan.",
      "Anda sulit menetapkan batasan terhadap permintaan orang lain.",
      "Anda merasa bertanggung jawab atas masalah semua orang.",
      "Anda mengabaikan kebutuhan Anda sendiri demi terus memberi.",
    ]},
    growth: { desc: "Bentuk paling matang dari Contribution adalah memberi tanpa kehilangan diri sendiri.", points: [
      "Anda memberi dengan kesadaran dan keseimbangan.",
      "Anda memahami batas tanggung jawab Anda sendiri.",
      "Anda memberdayakan orang lain, bukan menyelamatkan mereka.",
      "Anda menghubungkan kontribusi dengan kebijaksanaan, bukan pengorbanan.",
    ]},
    challenge: { title: "Belajar Memberi Secara Berkelanjutan", lesson: "Inti tantangan Anda bukan memberi lebih banyak, tapi belajar bahwa merawat diri sendiri juga bagian dari kontribusi yang sehat.", points: [
      "Anda tidak bisa membantu semua orang.",
      "Merawat diri sendiri bukan tindakan egois.",
      "Dampak besar membutuhkan keberlanjutan.",
      "Memberdayakan lebih efektif daripada menyelamatkan.",
    ], question: "Bantuan yang baru saja Anda berikan tadi, lahir dari kelapangan hati, atau dari rasa tidak enak kalau menolak?" },
  },
};

/* ============================================================
   BAB 7: Driver Development Path™ (5 tahap)
   Sumber: Theoretical Foundation V1, Bab 7.5
   ============================================================ */
const IMT_DEV_STAGES = [
  { key: "unaware", min: 0, max: 20, name: "Unaware™", icon: "①", focus: "Membangun kesadaran.",
    meaning: "Driver Anda bekerja di balik layar tanpa banyak Anda sadari. Ia memengaruhi pilihan Anda, tapi Anda jarang berhenti untuk mengenalinya secara langsung." },
  { key: "aware", min: 21, max: 40, name: "Aware™", icon: "②", focus: "Meningkatkan pemahaman diri.",
    meaning: "Anda mulai bisa menangkap kapan driver ini muncul, meski belum selalu paham kenapa ia muncul justru di momen-momen tertentu." },
  { key: "understanding", min: 41, max: 60, name: "Understanding™", icon: "③", focus: "Menghubungkan Driver dengan kehidupan nyata.",
    meaning: "Anda sudah bisa menghubungkan titik-titiknya, melihat bagaimana driver ini ikut membentuk keputusan, hubungan, dan reaksi Anda sehari-hari." },
  { key: "managing", min: 61, max: 80, name: "Managing™", icon: "④", focus: "Regulasi dan pengelolaan Driver.",
    meaning: "Anda mulai bisa mengelola driver ini dengan sengaja, memilih kapan mengikutinya dan kapan menahannya, bukan sekadar bereaksi begitu saja." },
  { key: "transforming", min: 81, max: 100, name: "Transforming™", icon: "⑤", focus: "Transformasi dan aktualisasi potensi.",
    meaning: "Driver ini sudah menjadi kekuatan yang Anda pakai secara sadar untuk membangun hidup yang Anda inginkan, bukan lagi sesuatu yang diam-diam mengendalikan Anda." },
];

function imtStageFor(score) {
  return IMT_DEV_STAGES.find(s => score >= s.min && score <= s.max) || IMT_DEV_STAGES[IMT_DEV_STAGES.length - 1];
}

/* ============================================================
   Validity / Consistency Check™
   Menggabungkan empat lapisan deteksi:
   1) Item-level per-driver: 5 pasang Consistency (parafrase soal
      inti) + 5 item Authenticity, tersembunyi di antara 50 soal.
   2) Modul validitas terpisah (id 51-56, driver "general"): 2 pasang
      Consistency + 2 item Authenticity tambahan di akhir tes, di luar
      8 soal inti/driver sehingga tidak mengorbankan pengukuran Driver.
   3) Statistik keseluruhan atas jawaban soal inti: straight-lining,
      variasi terlalu rendah, extreme responding.
   4) Sinyal kecepatan menjawab (opsional, dikirim lewat `meta` dari
      test.html): proporsi jawaban yang diberikan sangat cepat (<1 detik),
      indikasi asal-klik tanpa membaca.
   Ini bukan bagian dari IMT Knowledge Base resmi, ditambahkan
   sebagai lapisan keamanan psikometri dasar untuk prototype.
   ============================================================ */
function imtValidity(answers, meta = {}) {
  const coreVals = IMT_QUESTIONS.filter(q => q.type === "core" || q.type === "reverse core")
    .map(q => {
      let val = Number(answers[q.id]);
      return (q.type === "reverse core" && !isNaN(val)) ? 8 - val : val;
    }).filter(v => !isNaN(v));
  const n = coreVals.length;
  if (n === 0) return { flag: false, label: "Tidak Diketahui", reasons: [], sd: 0, extremePct: 0, consistencyResults: [], authenticityFlags: 0 };

  // --- Lapisan 1+2: semua item consistency (per-driver + modul) ---
  const consistencyItems = IMT_QUESTIONS.filter(q => q.type === "consistency" || q.type === "module_consistency");
  const consistencyResults = consistencyItems.map(q => {
    const pairVal = Number(answers[q.pairWith]);
    const thisVal = Number(answers[q.id]);
    const diff = (!isNaN(pairVal) && !isNaN(thisVal)) ? Math.abs(pairVal - thisVal) : null;
    return { driver: q.driver, type: q.type, diff, flagged: diff !== null && diff >= 3 };
  });
  const inconsistentDrivers = consistencyResults.filter(r => r.flagged && r.type === "consistency").map(r => r.driver);
  const moduleInconsistent = consistencyResults.some(r => r.flagged && r.type === "module_consistency");

  // --- Lapisan 1+2: semua item authenticity (per-driver + modul) ---
  const authenticityItems = IMT_QUESTIONS.filter(q => q.type === "authenticity" || q.type === "module_authenticity");
  const authenticityFlags = authenticityItems.filter(q => Number(answers[q.id]) >= 6).length;
  const authenticityRatio = authenticityItems.length > 0 ? authenticityFlags / authenticityItems.length : 0;

  // --- Lapisan 3: Statistik keseluruhan atas jawaban soal inti ---
  const mean = coreVals.reduce((a, b) => a + b, 0) / n;
  const variance = coreVals.reduce((a, b) => a + (b - mean) ** 2, 0) / n;
  const sd = Math.sqrt(variance);
  const uniqueVals = new Set(coreVals).size;
  const extremeCount = coreVals.filter(v => v === 1 || v === 7).length;
  const extremePct = Math.round((extremeCount / n) * 100);

  // --- Lapisan 4: kecepatan menjawab (dari test.html, opsional) ---
  const fastCount = meta.fastAnswerCount || 0;
  const totalAnswered = meta.totalAnswered || 0;
  const fastRatio = totalAnswered > 0 ? fastCount / totalAnswered : 0;

  const reasons = [];
  if (uniqueVals === 1) reasons.push("Semua jawaban identik (straight-lining), kemungkinan tidak dijawab dengan cermat.");
  else if (sd < 0.6) reasons.push("Variasi jawaban sangat rendah antar pernyataan.");
  if (extremePct > 85) reasons.push("Lebih dari 85% jawaban berada di ujung skala (1 atau 7), pola extreme responding.");
  if (inconsistentDrivers.length > 0) {
    const names = [...new Set(inconsistentDrivers)].map(d => IMT_DRIVERS[d].name).join(", ");
    reasons.push(`Jawaban tidak konsisten terdeteksi antara soal inti dan soal parafrasenya pada driver: ${names}.`);
  }
  if (moduleInconsistent) reasons.push("Jawaban tidak konsisten terdeteksi pada modul validitas tambahan di akhir tes.");
  if (authenticityRatio >= 0.5) {
    reasons.push("Beberapa jawaban condong ke pernyataan absolut yang tidak realistis (\"selalu\"/\"tidak pernah\"), indikasi social-desirability bias.");
  }
  if (fastRatio > 0.3) {
    reasons.push(`${Math.round(fastRatio * 100)}% jawaban diberikan sangat cepat (di bawah 1 detik), kemungkinan tidak sempat membaca pernyataan dengan cermat.`);
  }

  const flag = reasons.length > 0;
  let label = "Tinggi";
  if (flag) label = "Rendah";
  else if (sd < 1.1 || inconsistentDrivers.length > 0 || authenticityFlags >= 1 || fastRatio > 0.1) label = "Sedang";

  return { flag, label, reasons, sd: Math.round(sd * 100) / 100, extremePct, consistencyResults, authenticityFlags, fastCount, fastRatio: Math.round(fastRatio * 100) / 100 };
}
