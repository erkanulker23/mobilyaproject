window.AWA = (function () {
  var IMG = function (p) { return "background:url('" + p + "') center/cover"; };
  var IMAGES = ['uploads/1.png','uploads/2.png','uploads/3.png','uploads/4.png','uploads/5.png','uploads/6.png','uploads/7.png','uploads/8.png','uploads/9.png'];

  var PRODUCTS = [
    {id:'exence',cat:'koltuk',tr:'Exence Koltuk Takımı',en:'Exence Sofa Set',img:'uploads/2.png'},
    {id:'harmony',cat:'koltuk',tr:'Harmony Koltuk Takımı',en:'Harmony Sofa Set',img:'uploads/5.png'},
    {id:'lucid',cat:'koltuk',tr:'Lucid Koltuk Takımı',en:'Lucid Sofa Set',img:'uploads/6.png'},
    {id:'rivian',cat:'kose',tr:'Rivian Köşe Takımı',en:'Rivian Corner Set',img:'uploads/1.png'},
    {id:'nova',cat:'kose',tr:'Nova Köşe Takımı',en:'Nova Corner Set',img:'uploads/8.png'},
    {id:'corner',cat:'kose',tr:'Corner Köşe Takımı',en:'Corner Sectional',img:'uploads/9.png'},
    {id:'serene',cat:'yatak',tr:'Serene Yatak Odası',en:'Serene Bedroom',img:'uploads/3.png'},
    {id:'aura',cat:'yatak',tr:'Aura Yatak Odası',en:'Aura Bedroom',img:'uploads/4.png'},
    {id:'vivo',cat:'yemek',tr:'Vivo Yemek Odası',en:'Vivo Dining Room',img:'uploads/7.png'},
    {id:'lina',cat:'yemek',tr:'Lina Yemek Odası',en:'Lina Dining Room',img:'uploads/9.png'}
  ];
  var CATS_DEFAULT = [
    {id:'koltuk',tr:'Koltuk Takımları',en:'Sofa Sets',img:'uploads/2.png',dTr:'Modern çizgileri ve yumuşak oturum konforuyla yaşam alanınıza karakter katan koltuk takımları.',dEn:'Sofa sets that add character to your living space with modern lines and soft seating comfort.'},
    {id:'kose',tr:'Köşe Takımları',en:'Corner Sets',img:'uploads/7.png',dTr:'Geniş aileler ve sosyal yaşam için tasarlanan, mekânı verimli kullanan köşe takımları.',dEn:'Corner sets designed for large families and social living, using space efficiently.'},
    {id:'yatak',tr:'Yatak Odası',en:'Bedroom',img:'uploads/1.png',dTr:'Huzurlu bir uyku ve şık bir dinlenme alanı için tasarlanmış yatak odası koleksiyonları.',dEn:'Bedroom collections designed for restful sleep and an elegant resting area.'},
    {id:'yemek',tr:'Yemek Odası',en:'Dining Room',img:'uploads/3.png',dTr:'Sofra keyfini bir araya getiren, zarif ve dayanıklı yemek odası takımları.',dEn:'Elegant and durable dining room sets that bring the joy of the table together.'}
  ];
  var PIECEIMG = {
    koltuk:['uploads/9.png','uploads/4.png','uploads/2.png'],
    kose:['uploads/8.png','uploads/1.png','uploads/9.png'],
    yatak:['uploads/3.png','uploads/4.png','uploads/6.png'],
    yemek:['uploads/7.png','uploads/3.png','uploads/9.png']
  };
  var PIECES = {
    koltuk:[{tr:'Üçlü Kanepe',en:'3-Seat Sofa',d:'G/W: 240 · D/D: 95 · Y/H: 85'},{tr:'İkili Kanepe',en:'2-Seat Sofa',d:'G/W: 180 · D/D: 95 · Y/H: 85'},{tr:'Tekli Berjer',en:'Armchair',d:'G/W: 90 · D/D: 88 · Y/H: 82'}],
    kose:[{tr:'Köşe Kanepe',en:'Corner Sofa',d:'G/W: 320 · D/D: 180 · Y/H: 85'},{tr:'Üçlü Modül',en:'3-Seat Module',d:'G/W: 240 · D/D: 95 · Y/H: 85'},{tr:'Puf',en:'Ottoman',d:'G/W: 90 · D/D: 70 · Y/H: 42'}],
    yatak:[{tr:'Karyola',en:'Bed Frame',d:'G/W: 180 · D/D: 210 · Y/H: 120'},{tr:'Komodin',en:'Nightstand',d:'G/W: 55 · D/D: 42 · Y/H: 50'},{tr:'Gardırop',en:'Wardrobe',d:'G/W: 260 · D/D: 62 · Y/H: 220'}],
    yemek:[{tr:'Yemek Masası',en:'Dining Table',d:'G/W: 200 · D/D: 100 · Y/H: 76'},{tr:'Sandalye (6 adet)',en:'Chairs (set of 6)',d:'G/W: 48 · D/D: 56 · Y/H: 95'},{tr:'Konsol',en:'Console',d:'G/W: 180 · D/D: 45 · Y/H: 85'}]
  };
  var NEWSIMG = ['uploads/3.png','uploads/2.png','uploads/5.png','uploads/6.png','uploads/8.png','uploads/4.png'];

  var FEATURES = {
    tr:['El işçiliğiyle üretilen sağlam ahşap karkas','Yüksek yoğunluklu, yumuşak oturum süngeri','Leke tutmayan, çıkarılabilir kumaş kılıf','Geniş renk ve kumaş seçeneği','2 yıl üretici garantisi'],
    en:['Solid handcrafted wooden frame','High-density, soft seating foam','Stain-resistant, removable fabric cover','Wide range of colours and fabrics','2-year manufacturer warranty']
  };

  function defaultData() {
    return {
      settings:{ phone:'444 96 16', email:'info@awamobilya.com',
        logo:'', favicon:'', brandTr:'AWA', brandSub:'MOBİLYA',
        addressTr:'Masko Mobilya Kenti 5. Cadde No: 12, Başakşehir / İstanbul',
        addressEn:'Masko Furniture City 5th Ave No: 12, Başakşehir / Istanbul',
        hoursTr:'Hafta içi 09:00 – 18:00 · Cumartesi 10:00 – 17:00',
        hoursEn:'Weekdays 09:00 – 18:00 · Saturday 10:00 – 17:00',
        aboutTr:'Sektörü iyi analiz ederek teknoloji ile el emeğini birleştiren, markalaşmaya önem veren AWA Mobilya; dinamik ve sezgisel yapısıyla sektörün öncü firmalarından biridir. Bu başarıya, günümüz çizgisini yönlendiren ve geleceğin felsefesini şekillendiren ürünler üreterek ulaşmıştır.',
        aboutEn:'By analysing the industry well and combining technology with craftsmanship, AWA Mobilya has become one of the pioneering brands of the sector with its dynamic and intuitive structure. It has reached this success by producing pieces that shape the lines of today and the philosophy of tomorrow.',
        seoTitleTr:'AWA Mobilya — Kurumsal Mobilya & Koltuk Üreticisi',
        seoTitleEn:'AWA Mobilya — Contract Furniture & Sofa Manufacturer',
        seoDescTr:'AWA Mobilya; koltuk takımları, köşe takımları, yatak ve yemek odası koleksiyonları üreten kurumsal mobilya markası. 35+ yıllık tecrübe, 40+ ülkeye ihracat.',
        seoDescEn:'AWA Mobilya is a contract furniture brand producing sofa sets, corner sets, bedroom and dining collections. 35+ years of experience, exporting to 40+ countries.',
        seoKeywords:'AWA Mobilya, koltuk takımı, köşe takımı, yatak odası, yemek odası, kurumsal mobilya, mobilya üreticisi',
        ogImage:'uploads/1.png',
        mailRecipient:'satis@awamobilya.com', mailSender:'noreply@awamobilya.com',
        smtpHost:'smtp.awamobilya.com', smtpPort:'587', smtpUser:'noreply@awamobilya.com', smtpPass:'', smtpSecure:'TLS' },
      categories:[
        {id:'koltuk',tr:'Koltuk Takımları',en:'Sofa Sets',img:'uploads/2.png',dTr:'Modern çizgileri ve yumuşak oturum konforuyla yaşam alanınıza karakter katan koltuk takımları.',dEn:'Sofa sets that add character to your living space with modern lines and soft seating comfort.'},
        {id:'kose',tr:'Köşe Takımları',en:'Corner Sets',img:'uploads/7.png',dTr:'Geniş aileler ve sosyal yaşam için tasarlanan, mekânı verimli kullanan köşe takımları.',dEn:'Corner sets designed for large families and social living, using space efficiently.'},
        {id:'yatak',tr:'Yatak Odası',en:'Bedroom',img:'uploads/1.png',dTr:'Huzurlu bir uyku ve şık bir dinlenme alanı için tasarlanmış yatak odası koleksiyonları.',dEn:'Bedroom collections designed for restful sleep and an elegant resting area.'},
        {id:'yemek',tr:'Yemek Odası',en:'Dining Room',img:'uploads/3.png',dTr:'Sofra keyfini bir araya getiren, zarif ve dayanıklı yemek odası takımları.',dEn:'Elegant and durable dining room sets that bring the joy of the table together.'}
      ],
      slides:[
        {id:'s1',img:'uploads/1.png',subTr:'KÖŞE TAKIMLARI',subEn:'CORNER SETS',productId:'rivian'},
        {id:'s2',img:'uploads/3.png',subTr:'KOLTUK TAKIMLARI',subEn:'SOFA SETS',productId:'lucid'},
        {id:'s3',img:'uploads/7.png',subTr:'YENİ KOLEKSİYON',subEn:'NEW COLLECTION',productId:'exence'}
      ],
      products: PRODUCTS.map(function(p){return Object.assign({},p);}),
      news:[
        {id:'n1',date:'12.06.2026',catTr:'Fuar',catEn:'Fair',tr:'AWA Mobilya İstanbul Mobilya Fuarı’nda',en:'AWA at the Istanbul Furniture Fair',exTr:'Yeni koleksiyonumuzu CNR İMOB standımızda ziyaretçilerle buluşturduk.',exEn:'We presented our new collection to visitors at the CNR İMOB stand.',
         bodyTr:'AWA Mobilya, bu yıl 28.’si düzenlenen CNR İMOB İstanbul Mobilya Fuarı’nda yerini aldı.\nStandımızda; Exence, Lucid ve Rivian başta olmak üzere 2026 koleksiyonumuzun öne çıkan modellerini sergiledik.\nYurt içinden ve yurt dışından gelen binlerce ziyaretçiyi ağırladığımız fuarda, yeni ihracat iş birlikleri için önemli görüşmeler gerçekleştirdik.',
         bodyEn:'AWA Mobilya took its place at the 28th CNR İMOB Istanbul Furniture Fair this year.\nAt our stand we exhibited the highlights of our 2026 collection, including Exence, Lucid and Rivian.\nDuring the fair, where we welcomed thousands of visitors from home and abroad, we held important meetings for new export partnerships.'},
        {id:'n2',date:'28.05.2026',catTr:'Koleksiyon',catEn:'Collection',tr:'2026 İlkbahar Koleksiyonu yayında',en:'2026 Spring Collection is live',exTr:'Doğal kumaşlar ve sıcak tonlarla tasarlanan yeni serimiz mağazalarda.',exEn:'Our new series with natural fabrics and warm tones is now in stores.',
         bodyTr:'2026 İlkbahar Koleksiyonumuz, doğadan ilham alan sıcak tonlar ve yumuşak dokularla hazırlandı.\nBouclé ve kadife kumaşların ön plana çıktığı koleksiyonda, organik formlar ve yuvarlatılmış hatlar dikkat çekiyor.\nTüm modeller yetkili bayilerimizde ve online katalogumuzda incelenebilir.',
         bodyEn:'Our 2026 Spring Collection is crafted with warm, nature-inspired tones and soft textures.\nFeaturing bouclé and velvet fabrics, the collection stands out with organic forms and rounded lines.\nAll models can be explored at our authorised dealers and in our online catalog.'},
        {id:'n3',date:'15.04.2026',catTr:'Kurumsal',catEn:'Corporate',tr:'Yeni üretim tesisimiz açıldı',en:'Our new production facility is open',exTr:'18.000 m² kapalı alana sahip tesisimizle üretim kapasitemizi ikiye katladık.',exEn:'We doubled our production capacity with a new 18,000 m² facility.',
         bodyTr:'Büyüyen talebi karşılamak için 18.000 m² kapalı alana sahip yeni üretim tesisimizi hizmete aldık.\nModern üretim hatları ve nitelikli iş gücüyle kapasitemizi ikiye katladık.\nYeni tesisimiz, sürdürülebilir üretim ilkelerine uygun olarak tasarlandı.',
         bodyEn:'To meet growing demand, we have opened our new 18,000 m² production facility.\nWith modern production lines and a qualified workforce, we have doubled our capacity.\nThe new facility is designed in line with sustainable production principles.'},
        {id:'n4',date:'02.03.2026',catTr:'Sürdürülebilirlik',catEn:'Sustainability',tr:'Sürdürülebilir üretim sertifikası aldık',en:'We earned a sustainable production certificate',exTr:'FSC sertifikalı ahşap kullanımıyla çevresel sorumluluğumuzu büyütüyoruz.',exEn:'We grow our environmental responsibility with FSC-certified wood.',
         bodyTr:'Çevresel sorumluluğumuzun bir parçası olarak FSC sertifikalı ahşap kullanımına geçtik.\nÜretim süreçlerimizde atık yönetimi ve enerji verimliliği konularında önemli adımlar attık.\nGeleceğe daha yaşanabilir bir dünya bırakmak için çalışmaya devam ediyoruz.',
         bodyEn:'As part of our environmental responsibility, we switched to FSC-certified wood.\nWe have taken significant steps in waste management and energy efficiency in our processes.\nWe continue to work to leave a more liveable world for the future.'},
        {id:'n5',date:'20.01.2026',catTr:'Tasarım',catEn:'Design',tr:'Tasarım ödülüne layık görüldük',en:'Honored with a design award',exTr:'Lucid serimiz uluslararası bir tasarım ödülünün sahibi oldu.',exEn:'Our Lucid series received an international design award.',
         bodyTr:'Lucid koltuk serimiz, uluslararası jüri tarafından yılın tasarımı ödülüne layık görüldü.\nMinimal çizgileri ve fonksiyonel detaylarıyla öne çıkan seri, tasarım ekibimizin uzun süreli çalışmasının ürünü.\nBu ödül, kullanıcı odaklı tasarım anlayışımızın bir göstergesi.',
         bodyEn:'Our Lucid sofa series was awarded design of the year by an international jury.\nStanding out with its minimal lines and functional details, the series is the product of our design team’s long work.\nThis award is a testament to our user-focused design approach.'},
        {id:'n6',date:'05.12.2025',catTr:'İhracat',catEn:'Export',tr:'40. ülkeye ihracata başladık',en:'We started exporting to our 40th country',exTr:'Avrupa ve Orta Doğu’nun ardından ihracat ağımızı genişletmeye devam ediyoruz.',exEn:'After Europe and the Middle East, we keep expanding our export network.',
         bodyTr:'AWA Mobilya, ihracat ağına 40. ülkeyi ekleyerek küresel büyümesini sürdürüyor.\nAvrupa, Orta Doğu ve Kuzey Afrika pazarlarının ardından yeni bölgelere açılıyoruz.\nKalite standartlarımız, uluslararası pazarlarda markamızın tercih edilmesini sağlıyor.',
         bodyEn:'AWA Mobilya continues its global growth by adding the 40th country to its export network.\nAfter the European, Middle Eastern and North African markets, we are expanding into new regions.\nOur quality standards make our brand a preferred choice in international markets.'}
      ],
      dealers:[
        {id:'d1',city:'İstanbul — Merkez',addr:'Masko Mobilya Kenti, Başakşehir / İstanbul',tel:'444 96 16'},
        {id:'d2',city:'Ankara',addr:'Siteler Karacakaya Cad. No:121, Altındağ / Ankara',tel:'+90 312 000 00 00'},
        {id:'d3',city:'İzmir',addr:'Karabağlar Mobilyacılar Sitesi, İzmir',tel:'+90 232 000 00 00'},
        {id:'d4',city:'Bursa',addr:'Nilüfer Organize Sanayi Bölgesi, Bursa',tel:'+90 224 000 00 00'},
        {id:'d5',city:'Antalya',addr:'Döşemealtı Mobilya OSB, Antalya',tel:'+90 242 000 00 00'},
        {id:'d6',city:'Adana',addr:'Yeni Mobilyacılar Sitesi, Seyhan / Adana',tel:'+90 322 000 00 00'}
      ],
      pages:{
        mesafeli:{ tTr:'Mesafeli Satış Sözleşmesi', tEn:'Distance Sales Agreement',
          bTr:'1. Taraflar\nİşbu sözleşme; bir tarafta AWA Mobilya (Satıcı) ile diğer tarafta ürün/hizmet talebinde bulunan Alıcı arasında, aşağıda belirtilen hüküm ve şartlar dahilinde elektronik ortamda kurulmuştur.\n2. Sözleşmenin Konusu\nİşbu sözleşmenin konusu, Alıcı’nın AWA Mobilya’dan elektronik ortamda talep ettiği ürünlerin satışı ve teslimi ile ilgili tarafların hak ve yükümlülüklerinin belirlenmesidir.\n3. Ürün Bilgileri ve Teslimat\nÜrünlerin temel nitelikleri, ölçüleri ve renk seçenekleri ürün detay sayfalarında belirtilmiştir. Üretim ve teslimat süreleri sipariş onayını takiben Alıcı’ya bildirilir.\n4. Cayma Hakkı\nAlıcı, kişiye özel üretilen ürünler hariç olmak üzere, teslim tarihinden itibaren yürürlükteki mevzuatın öngördüğü süre içinde cayma hakkını kullanabilir.\n5. Uyuşmazlıkların Çözümü\nİşbu sözleşmeden doğabilecek uyuşmazlıklarda, ilgili mevzuatta belirtilen Tüketici Hakem Heyetleri ve Tüketici Mahkemeleri yetkilidir.',
          bEn:'1. Parties\nThis agreement is concluded electronically between AWA Mobilya (Seller) and the Buyer requesting products/services, under the terms and conditions set out below.\n2. Subject\nThe subject of this agreement is to determine the rights and obligations regarding the sale and delivery of the products requested by the Buyer from AWA Mobilya.\n3. Product Information & Delivery\nThe essential qualities, dimensions and colour options of the products are stated on the product detail pages. Production and delivery times are communicated after order confirmation.\n4. Right of Withdrawal\nExcept for customised products, the Buyer may exercise the right of withdrawal within the period stipulated by the applicable legislation from the delivery date.\n5. Disputes\nIn disputes arising from this agreement, the Consumer Arbitration Committees and Consumer Courts specified in the relevant legislation are authorised.' },
        kvkk:{ tTr:'KVKK Aydınlatma Metni', tEn:'Personal Data Protection Notice',
          bTr:'Veri Sorumlusu\n6698 sayılı Kişisel Verilerin Korunması Kanunu uyarınca veri sorumlusu sıfatıyla AWA Mobilya tarafından kişisel verileriniz aşağıda açıklanan kapsamda işlenmektedir.\nİşlenen Kişisel Veriler\nİletişim formu ve e-bülten aracılığıyla ad-soyad, e-posta ve telefon bilgileriniz toplanmaktadır.\nİşleme Amaçları\nVerileriniz; talep ve şikayetlerin yönetilmesi, ürün ve kampanya bilgilendirmeleri ile yasal yükümlülüklerin yerine getirilmesi amacıyla işlenir.\nHaklarınız\nKanun’un 11. maddesi kapsamında verilerinize ilişkin bilgi talep etme, düzeltme ve silme haklarına sahipsiniz.',
          bEn:'Data Controller\nIn accordance with Law No. 6698, your personal data is processed by AWA Mobilya as the data controller within the scope explained below.\nProcessed Data\nYour name, e-mail and phone information are collected via the contact form and newsletter.\nPurposes\nYour data is processed to manage requests and complaints, provide product and campaign information, and fulfil legal obligations.\nYour Rights\nUnder Article 11 of the Law, you have the right to request information about, correct and delete your data.' },
        gizlilik:{ tTr:'Gizlilik Politikası', tEn:'Privacy Policy',
          bTr:'Toplanan Bilgiler\nWeb sitemizi ziyaretiniz sırasında yalnızca sizin paylaşmayı tercih ettiğiniz bilgiler toplanır.\nÇerezler\nDeneyiminizi iyileştirmek için çerezler kullanılır; tarayıcı ayarlarınızdan çerez tercihlerinizi yönetebilirsiniz.\nGüvenlik\nKişisel verileriniz, yetkisiz erişime karşı uygun teknik ve idari tedbirlerle korunmaktadır.',
          bEn:'Information Collected\nDuring your visit, only the information you choose to share with us is collected.\nCookies\nCookies are used to improve your experience; you can manage your cookie preferences from your browser settings.\nSecurity\nYour personal data is protected with appropriate technical and administrative measures against unauthorised access.' }
      }
    };
  }

  var STR = {
    tr:{
      nav:{home:'ANA SAYFA',corporate:'KURUMSAL',collection:'KOLEKSİYON',news:'HABERLER',dealers:'BAYİLER',contact:'İLETİŞİM'},
      searchPh:'Ürün ara...', searchEmpty:'Sonuç bulunamadı.', thanks:'Teşekkürler! En kısa sürede dönüş yapacağız.',
      cta:{discover:'KEŞFET',explore:'KEŞFET',exploreProducts:'ÜRÜNLERİ KEŞFET',download:'KATALOĞU İNDİR',allCollections:'TÜM KOLEKSİYON',viewAll:'TÜMÜNÜ GÖR',requestInfo:'BİLGİ İSTE',send:'GÖNDER',onlineCatalog:'ONLINE KATALOG'},
      featured:{kicker:'KOLEKSİYON',title:'Koltuk Takımları',desc:'En yeni tasarımlarımızı siz değerli müşterilerimizin beğenisine sunuyoruz. En son koleksiyonlarımızı keşfedin.'},
      about:{kicker:'HAKKIMIZDA',title:'AWA Mobilya'},
      catalog:{title:'Online Katalog',desc:'Tüm koleksiyonlarımızı, ölçüleri ve kumaş seçeneklerini tek bir dijital katalogda inceleyin.'},
      collections:{kicker:'ÜRÜNLER',title:'Koleksiyon',product:'ürün',resultsT:'ürün listeleniyor'},
      newsSec:{kicker:'GÜNDEM',title:'Haberler'},
      newsletter:{title:'E-bültenimize abone olun',desc:'AWA dünyasının yeni ürünleri ve etkinlikleri hakkında güncel bilgileri takip etmek için.',placeholder:'E-posta adresiniz...',thanks:'Aboneliğiniz alındı, teşekkürler.'},
      footer:{distance:'Mesafeli Satış Sözleşmesi',admin:'Yönetim Paneli',tag:'kurumsal mobilya',explore:'Keşfet',corporate:'Kurumsal',contact:'İletişim',rights:'Tüm hakları saklıdır.'},
      corpPage:{kicker:'KURUMSAL',title:'AWA Mobilya',story2:'140’tan fazla kalifiye çalışanı ve 35 yılı aşan tecrübesiyle AWA; tasarımdan üretime, lojistikten satış sonrası hizmetlere kadar her aşamada kalite standartlarını koruyarak büyümeye devam etmektedir.',missionT:'Misyonumuz',missionP:'İnsanların yaşam alanlarına değer katan, konforu ve estetiği bir araya getiren, uzun ömürlü mobilyalar üretmek.',visionT:'Vizyonumuz',visionP:'Tasarım gücü ve üretim kalitesiyle ulusal ve uluslararası pazarda tercih edilen öncü bir marka olmak.',valuesT:'Değerlerimiz',values:[{t:'Tasarım',d:'Zamansız, fonksiyonel ve karakterli tasarımlar geliştiriyoruz.'},{t:'Kalite',d:'Malzeme seçiminden işçiliğe kadar her detayda kaliteyi önceliklendiriyoruz.'},{t:'Sürdürülebilirlik',d:'Sertifikalı malzemeler ve sorumlu üretimle geleceği gözetiyoruz.'}],socialKicker:'SOSYAL SORUMLULUK',socialT:'Topluma ve doğaya karşı sorumluyuz',socialP:'Eğitim, çevre ve istihdam alanlarındaki projelerimizle bulunduğumuz topluma değer katmayı sürdürüyoruz.'},
      productPage:{contents:'Takım İçeriği',related:'Benzer Ürünler',formTitle:'Bilgi Almak İster Misiniz?',formDesc:'Bu ürün hakkında detaylı bilgi, fiyat ve en yakın bayi için bizimle iletişime geçin.',overview:'Ürün Hakkında',featuresT:'Öne Çıkan Özellikler',gallery:'Galeri'},
      specs:[{l:'Garanti',v:'2 Yıl'},{l:'Üretim',v:'Türkiye'},{l:'Teslimat',v:'4–6 Hafta'}],
      articlePage:{back:'‹ Tüm Haberler',related:'Diğer Haberler',share:'Paylaş'},
      form:{name:'Adınız, soyadınız',email:'E-posta',phone:'Telefon',msg:'Mesajınız...'},
      newsPage:{intro:'AWA Mobilya’dan haberler, fuar takvimi, yeni koleksiyonlar ve kurumsal duyurular.',readMore:'Devamını Oku'},
      contactPage:{kicker:'BİZE ULAŞIN',getInTouch:'BİZE ULAŞIN',intro:'AWA Mobilya görüş ve önerilerinizi dinlemeye hazır. Size hızlı dönüş yapabilmemiz için formu eksiksiz doldurmanız yeterli.',formTitle:'Bize Yazın',hqLabel:'MERKEZ OFİS',phoneL:'Telefon',emailL:'E-posta',addressL:'Adres',hoursL:'Çalışma Saatleri',mapLabel:'harita · merkez ofis konumu'},
      dealersPage:{kicker:'SATIŞ NOKTALARI',title:'Bayilerimiz',intro:'Türkiye genelindeki yetkili satış noktalarımızdan size en yakını keşfedin. Tüm bayilerimizde koleksiyonlarımızı yerinde inceleyebilirsiniz.',mapLabel:'harita · bayi konumları',allT:'Tüm Bayiler'},
      faqPage:{kicker:'YARDIM',title:'Sıkça Sorulan Sorular',intro:'AWA Mobilya ürünleri, teslimat ve garanti hakkında en çok merak edilenler.'},
      faqs:[
        {q:'Ürünleriniz online satışta mı?',a:'Hayır. AWA Mobilya kurumsal bir üreticidir ve ürünlerini yetkili bayileri aracılığıyla sunar. Web sitemiz bir tanıtım ve katalog platformudur.'},
        {q:'Teslimat süresi ne kadar?',a:'Standart koleksiyon ürünlerinde teslimat genellikle 4–6 hafta arasındadır. Kişiye özel üretimlerde süre, sipariş onayında tarafınıza bildirilir.'},
        {q:'Ürünleriniz garantili mi?',a:'Evet, tüm ürünlerimiz 2 yıl üretici garantisi kapsamındadır.'},
        {q:'Kumaş ve renk seçeneği var mı?',a:'Evet. Her model için geniş kumaş ve renk seçenekleri sunulmaktadır; detaylar için bayilerimizle iletişime geçebilirsiniz.'},
        {q:'En yakın bayinizi nasıl bulurum?',a:'Bayiler sayfamızdan Türkiye genelindeki yetkili satış noktalarımıza ulaşabilirsiniz.'}
      ],
      sortDefault:'Öne Çıkanlar', sortAZ:'İsim (A → Z)', sortZA:'İsim (Z → A)', uploadL:'Bilgisayardan görsel yükle',
      legalPage:{label:'YASAL METİNLER'},
      admin:{reset:'Varsayılana Sıfırla',viewSite:'Siteyi Görüntüle',dashboard:'Kontrol Paneli',slides:'Slider',products:'Ürünler',categories:'Kategoriler',news:'Haberler / Blog',dealers:'Bayiler',pages:'Sayfalar',seo:'SEO Ayarları',general:'Genel Ayarlar',email:'E-posta / Sunucu',settings:'Site Ayarları',addProduct:'Ürün Ekle',addCategory:'Kategori Ekle',addNews:'Haber Ekle',addSlide:'Slayt Ekle',addDealer:'Bayi Ekle',note:'Değişiklikler tarayıcınıza otomatik kaydedilir ve sitede anında görünür.',body:'İçerik / Blog Metni',welcome:'Hoş geldiniz',welcomeSub:'Sitenizin tüm içeriğini buradan yönetebilirsiniz.',recent:'Son Haberler',shortcuts:'Hızlı İşlemler',brandT:'Marka & Logo',logoT:'Logo',faviconT:'Favicon (sekme simgesi)',upload:'Görsel Yükle',remove:'Kaldır',mailT:'E-posta Bildirimleri',smtpT:'SMTP Sunucu Ayarları',mailNote:'Form gönderimleri bu adrese iletilir. SMTP ayarları gerçek gönderim için bir sunucu entegrasyonu gerektirir.'}
    },
    en:{
      nav:{home:'HOME',corporate:'CORPORATE',collection:'COLLECTION',news:'NEWS',dealers:'DEALERS',contact:'CONTACT'},
      searchPh:'Search products...', searchEmpty:'No results found.', thanks:'Thank you! We will get back to you shortly.',
      cta:{discover:'DISCOVER',explore:'EXPLORE',exploreProducts:'EXPLORE PRODUCTS',download:'DOWNLOAD CATALOG',allCollections:'ALL COLLECTION',viewAll:'VIEW ALL',requestInfo:'REQUEST INFO',send:'SEND',onlineCatalog:'ONLINE CATALOG'},
      featured:{kicker:'COLLECTION',title:'Sofa Sets',desc:'We present our newest designs for your appreciation. Discover our latest collections.'},
      about:{kicker:'ABOUT US',title:'AWA Mobilya'},
      catalog:{title:'Online Catalog',desc:'Browse all our collections, dimensions and fabric options in a single digital catalog.'},
      collections:{kicker:'PRODUCTS',title:'Collection',product:'products',resultsT:'products listed'},
      newsSec:{kicker:'LATEST',title:'News'},
      newsletter:{title:'Subscribe to our newsletter',desc:'To follow the latest news about new products and events from the world of AWA.',placeholder:'Your e-mail address...',thanks:'You are subscribed, thank you.'},
      footer:{distance:'Distance Sales Agreement',admin:'Admin Panel',tag:'contract furniture',explore:'Explore',corporate:'Corporate',contact:'Contact',rights:'All rights reserved.'},
      corpPage:{kicker:'CORPORATE',title:'AWA Mobilya',story2:'With over 140 qualified employees and more than 35 years of experience, AWA keeps growing while maintaining quality standards at every stage — from design and production to logistics and after-sales service.',missionT:'Our Mission',missionP:'To produce long-lasting furniture that adds value to living spaces and unites comfort with aesthetics.',visionT:'Our Vision',visionP:'To be a leading brand of choice in national and international markets with our design strength and production quality.',valuesT:'Our Values',values:[{t:'Design',d:'We develop timeless, functional designs with character.'},{t:'Quality',d:'We prioritize quality in every detail, from material to craftsmanship.'},{t:'Sustainability',d:'We protect the future with certified materials and responsible production.'}],socialKicker:'SOCIAL RESPONSIBILITY',socialT:'Responsible to society and nature',socialP:'We continue to add value to our community through projects in education, the environment and employment.'},
      productPage:{contents:'Set Contents',related:'Related Products',formTitle:'Would You Like More Information?',formDesc:'Get in touch for detailed information, pricing and your nearest dealer for this product.',overview:'Overview',featuresT:'Key Features',gallery:'Gallery'},
      specs:[{l:'Warranty',v:'2 Years'},{l:'Made in',v:'Türkiye'},{l:'Delivery',v:'4–6 Weeks'}],
      articlePage:{back:'‹ All News',related:'More Articles',share:'Share'},
      form:{name:'Full name',email:'E-mail',phone:'Phone',msg:'Your message...'},
      newsPage:{intro:'News from AWA Mobilya — fair calendar, new collections and corporate announcements.',readMore:'Read More'},
      contactPage:{kicker:'GET IN TOUCH',getInTouch:'GET IN TOUCH',intro:'AWA Mobilya is ready to hear your thoughts. Just fill in the form completely so we can get back to you quickly.',formTitle:'Write to Us',hqLabel:'HEAD OFFICE',phoneL:'Phone',emailL:'E-mail',addressL:'Address',hoursL:'Working Hours',mapLabel:'map · head office location'},
      dealersPage:{kicker:'SALES POINTS',title:'Our Dealers',intro:'Find the nearest authorised sales point across Türkiye. You can explore our collections in person at all our dealers.',mapLabel:'map · dealer locations',allT:'All Dealers'},
      faqPage:{kicker:'HELP',title:'Frequently Asked Questions',intro:'The most common questions about AWA Mobilya products, delivery and warranty.'},
      faqs:[
        {q:'Do you sell online?',a:'No. AWA Mobilya is a contract manufacturer and offers its products through authorised dealers. Our website is a showcase and catalog platform.'},
        {q:'What is the delivery time?',a:'For standard collection items, delivery usually takes 4–6 weeks. For custom production, the time is communicated upon order confirmation.'},
        {q:'Are your products under warranty?',a:'Yes, all our products come with a 2-year manufacturer warranty.'},
        {q:'Are there fabric and colour options?',a:'Yes. A wide range of fabrics and colours is available for each model; contact our dealers for details.'},
        {q:'How do I find the nearest dealer?',a:'You can reach our authorised sales points across Türkiye from our Dealers page.'}
      ],
      sortDefault:'Featured', sortAZ:'Name (A → Z)', sortZA:'Name (Z → A)', uploadL:'Upload image from computer',
      legalPage:{label:'LEGAL DOCUMENTS'},
      admin:{reset:'Reset to default',viewSite:'View site',dashboard:'Dashboard',slides:'Slider',products:'Products',categories:'Categories',news:'News / Blog',dealers:'Dealers',pages:'Pages',seo:'SEO Settings',general:'General Settings',email:'E-mail / Server',settings:'Settings',addProduct:'Add product',addCategory:'Add category',addNews:'Add article',addSlide:'Add slide',addDealer:'Add dealer',note:'Changes are saved to your browser automatically and appear on the site instantly.',body:'Content / Blog text',welcome:'Welcome',welcomeSub:'Manage all of your site content from here.',recent:'Recent News',shortcuts:'Quick Actions',brandT:'Brand & Logo',logoT:'Logo',faviconT:'Favicon (tab icon)',upload:'Upload image',remove:'Remove',mailT:'E-mail Notifications',smtpT:'SMTP Server Settings',mailNote:'Form submissions are sent to this address. SMTP settings require a server integration for real delivery.'}
    }
  };

  function parseBody(txt) {
    var out = [];
    (txt || '').split('\n').forEach(function (ln) {
      var s = ln.trim(); if (!s) return;
      var isH = /^\d+[\.\)]/.test(s) || /:$/.test(s) || (s.length < 52 && /^[A-ZÇĞİÖŞÜ]/.test(s) && s.indexOf('. ') < 0 && s.slice(-1) !== '.');
      if (isH) out.push({ h:s, p:'', hStyle:'' });
      else {
        if (out.length && out[out.length-1].p === '' && out[out.length-1].h) out[out.length-1].p = s;
        else out.push({ h:'', p:s, hStyle:'display:none' });
      }
    });
    return out;
  }

  function setMeta(title, desc, lang, extra) {
    try {
      document.title = title;
      var md = document.querySelector('meta[name="description"]'); if (md) md.setAttribute('content', desc);
      var ot = document.querySelector('meta[property="og:title"]'); if (ot) ot.setAttribute('content', title);
      var od = document.querySelector('meta[property="og:description"]'); if (od) od.setAttribute('content', desc);
      if (document.documentElement) document.documentElement.lang = lang;
      extra = extra || {};
      var setNamed = function(name, val){ if(val==null) return; var m=document.querySelector('meta[name="'+name+'"]'); if(!m){ m=document.createElement('meta'); m.setAttribute('name',name); document.head.appendChild(m); } m.setAttribute('content',val); };
      var setProp = function(p, val){ if(val==null) return; var m=document.querySelector('meta[property="'+p+'"]'); if(!m){ m=document.createElement('meta'); m.setAttribute('property',p); document.head.appendChild(m); } m.setAttribute('content',val); };
      if (extra.keywords) setNamed('keywords', extra.keywords);
      if (extra.ogImage) setProp('og:image', extra.ogImage);
      if (extra.favicon) { var fav=document.querySelector('link[rel="icon"]'); if(!fav){ fav=document.createElement('link'); fav.setAttribute('rel','icon'); document.head.appendChild(fav); } fav.setAttribute('href', extra.favicon); }
    } catch (e) {}
  }

  function buildVM(c) {
    var s = c.state;
    var lang = s.lang || (c.props && c.props.defaultLang) || 'tr';
    var t = STR[lang];
    var accent = (c.props && c.props.accent) || '#9c8463';
    var page = s.page;
    var data = c.getData();
    var set = data.settings;
    var slides = (data.slides && data.slides.length) ? data.slides : defaultData().slides;
    var pages = data.pages || defaultData().pages;
    var CATS = (data.categories && data.categories.length) ? data.categories : CATS_DEFAULT;
    var M = s.isMobile;
    var sortMode = s.sort || 'default';
    var onHero = page === 'home' && !s.scrolled;
    var dropOpen = !!s.dropdown;
    var navColor = (onHero && !dropOpen) ? '#ffffff' : '#17140f';
    var headerStyle = dropOpen
      ? 'position:fixed;top:0;left:0;right:0;z-index:100;background:#fff'
      : (onHero
      ? 'position:fixed;top:0;left:0;right:0;z-index:100;background:transparent'
      : 'position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(246,243,237,.92);backdrop-filter:blur(14px);border-bottom:1px solid rgba(0,0,0,.07)');
    var link = function (a) { return 'white-space:nowrap;font-family:Archivo;font-weight:700;font-size:13px;letter-spacing:.14em;text-transform:uppercase;cursor:pointer;color:' + navColor + ';opacity:' + (a?1:.78) + ';padding:6px 0;border-bottom:2px solid ' + (a?accent:'transparent') + ';transition:opacity .25s ease,border-color .25s ease'; };
    var langStyle = function (a) { return 'cursor:pointer;color:' + navColor + ';opacity:' + (a?1:.5); };
    var kickerStyle = "font-family:'Space Mono';font-size:12px;letter-spacing:.2em;color:" + accent + ";text-transform:uppercase";

    var catName = function (id) { var x = CATS.filter(function(k){return k.id===id;})[0]; return x ? x[lang] : id; };
    var catDesc = function (id) { var x = CATS.filter(function(k){return k.id===id;})[0]; return x ? (lang==='tr'?x.dTr:x.dEn) : ''; };
    var catCount = function (id) { return data.products.filter(function(p){return p.cat===id;}).length; };
    var locP = function (p) { return { id:p.id, name:p[lang], catName:catName(p.cat), bg:IMG(p.img), onClick:function(){c.goProduct(p.id);} }; };

    // hero
    var hi = s.hero % slides.length;
    var hs = slides[hi];
    var hp = data.products.filter(function(p){return p.id===hs.productId;})[0] || data.products[0];
    var heroDots = slides.map(function (sl, i) { return { num:('0'+(i+1)).slice(-2), onClick:(function(idx){return function(){c.goHero(idx);};})(i), style:"cursor:pointer;font-family:'Space Mono';font-size:14px;color:#fff;opacity:" + (i===hi?1:.45) + ";border-bottom:2px solid " + (i===hi?'#fff':'transparent') + ";padding-bottom:3px" }; });
    var heroSlidesAll = slides.map(function (sl, i) { var pp = data.products.filter(function(x){return x.id===sl.productId;})[0] || data.products[0]; var stitle = (lang==='tr'?sl.titleTr:sl.titleEn); return { bg:IMG(sl.img), sub: lang==='tr'?sl.subTr:sl.subEn, title: stitle || (pp?pp[lang]:''), desc: (lang==='tr'?sl.descTr:sl.descEn) || '', onCta:(function(id){return function(){c.goProduct(id);};})(sl.productId), kb: i===hi?'animation:awaKen 7s ease-out forwards':'' }; });
    var heroTrackStyle = 'display:flex;height:100%;transition:transform .85s cubic-bezier(.7,0,.2,1);transform:translateX(-'+(hi*100)+'%)';

    // collection — geçerli kategori (yoksa ilk kategoriye düş)
    var curCat = (CATS.filter(function(k){return k.id===s.cat;})[0] ? s.cat : (CATS[0] ? CATS[0].id : s.cat));
    var filtered = data.products.filter(function(p){return p.cat===curCat;}).map(locP);
    if (sortMode==='az') filtered = filtered.slice().sort(function(a,b){return a.name.localeCompare(b.name);});
    else if (sortMode==='za') filtered = filtered.slice().sort(function(a,b){return b.name.localeCompare(a.name);});
    var sortOptions = [{v:'default',label:t.sortDefault},{v:'az',label:t.sortAZ},{v:'za',label:t.sortZA}];
    var catTabs = CATS.map(function (k) { return { label:k[lang], onClick:(function(id){return function(){c.goCollection(id);};})(k.id), style:'cursor:pointer;padding:11px 22px;border-radius:999px;font-family:Archivo;font-weight:700;font-size:12px;letter-spacing:.1em;text-transform:uppercase;' + (curCat===k.id?'background:#17140f;color:#fff':'background:#fff;color:#5d564b;border:1px solid #e0d8c9') }; });

    // product detail
    var curP = data.products.filter(function(p){return p.id===s.product;})[0] || data.products[0];
    var pcImgs = PIECEIMG[curP.cat] || PIECEIMG.koltuk;
    var galArr;
    if (curP.gallery && curP.gallery.length) {
      // Üründen gelen birden fazla görsel (DB galerisi)
      galArr = [curP.img]; curP.gallery.forEach(function(g){ if (g && galArr.indexOf(g)<0) galArr.push(g); });
    } else {
      galArr = [curP.img]; pcImgs.forEach(function(g){ if (galArr.indexOf(g)<0) galArr.push(g); });
    }
    galArr = galArr.filter(Boolean).slice(0,6);
    var gi = (s.gi || 0) % galArr.length;
    var gallery = galArr.map(function (g, i) { return { bg:IMG(g), onClick:(function(idx){return function(){c.setGi(idx);};})(i), style:'cursor:pointer;border-radius:10px;aspect-ratio:1/1;'+IMG(g)+';border:2px solid '+(i===gi?'#17140f':'transparent')+';opacity:'+(i===gi?1:.8) }; });
    var galSlides = galArr.map(function (g) { return { bg:IMG(g) }; });
    var galTrackStyle = 'display:flex;height:100%;transition:transform .8s cubic-bezier(.7,0,.2,1);transform:translateX(-'+(gi*100)+'%)';
    var galDots = galArr.map(function (g, i) { return { onClick:(function(idx){return function(){c.setGi(idx);};})(i), style:'cursor:pointer;width:'+(i===gi?'30px':'10px')+';height:10px;border-radius:999px;background:'+(i===gi?'#fff':'rgba(255,255,255,.45)')+';transition:width .35s ease,background .35s ease' }; });
    var prByCat = {
      koltuk:{tr:'Oturma alanının kalbinde yer alan koltuk takımı; yumuşak hatları, dengeli oranları ve özenle seçilmiş kumaşlarıyla mekâna sıcak bir karakter katar. Gün boyu konforu koruyan oturum yapısı, uzun yıllar formunu kaybetmeyen yüksek yoğunluklu süngerle desteklenir.',en:'At the heart of the living space, this sofa set brings a warm character with its soft lines, balanced proportions and carefully chosen fabrics.'},
      kose:{tr:'Geniş aileler ve sosyal yaşam için tasarlanan köşe takımı, mekânı verimli kullanırken ferah bir oturum sunar. Modüler yapısı sayesinde farklı yerleşimlere uyum sağlar; davetlerde ve günlük kullanımda eşit konfor verir.',en:'Designed for large families and social living, this corner set offers spacious seating while using space efficiently.'},
      yatak:{tr:'Huzurlu bir uyku ve sakin bir dinlenme alanı için tasarlanan yatak odası takımı; sade çizgileri ve dingin tonlarıyla odaya zarif bir bütünlük kazandırır. Fonksiyonel saklama çözümleri günlük yaşamı kolaylaştırır.',en:'Designed for restful sleep and a calm resting area, this bedroom set brings elegant unity to the room.'},
      yemek:{tr:'Sofranın keyfini bir araya getiren yemek odası takımı; dayanıklı yapısı ve zarif duruşuyla hem günlük öğünlerde hem özel davetlerde öne çıkar. Zamansız tasarımı farklı dekorasyon anlayışlarıyla uyum sağlar.',en:'Bringing the joy of the table together, this dining set stands out at both everyday meals and special gatherings.'}
    };
    var prLong = (lang==='tr'?curP.longTr:curP.longEn) || (prByCat[curP.cat] || prByCat.koltuk)[lang];
    var prDesc = (lang==='tr'?curP.descTr:curP.descEn) || catDesc(curP.cat);
    var product = { name:curP[lang], catName:catName(curP.cat), bg:IMG(curP.img), mainBg:IMG(galArr[gi]), curImg:galArr[gi], onMainClick:function(){c.openLightbox();}, desc:prDesc, longDesc:prLong, onBack:function(){c.goCollection(curP.cat);} };
    var productFeatures = FEATURES[lang].map(function (f) { return { txt:f }; });
    // Parçalar (Takım İçeriği) — admin "Ürünü Oluşturan Parçalar" (DB) varsa onu kullan
    var productPieces;
    if (curP.pieces && curP.pieces.length) {
      productPieces = curP.pieces.map(function (pc, i) { return { name:pc.name, dims:pc.dims, bg:IMG(pc.img ? pc.img : pcImgs[i % pcImgs.length]) }; });
    } else {
      productPieces = (PIECES[curP.cat] || PIECES.koltuk).map(function (pc, i) { return { name:pc[lang], dims:pc.d, bg:IMG(pcImgs[i % pcImgs.length]) }; });
    }
    var related = data.products.filter(function(p){return p.cat===curP.cat && p.id!==curP.id;}).slice(0,3).map(locP);
    if (related.length < 3) related = related.concat(data.products.filter(function(p){return p.id!==curP.id && related.map(function(r){return r.id;}).indexOf(p.id)<0;}).map(locP)).slice(0,3);

    // category cards (home)
    var catCards = CATS.map(function (k) { return { label:k[lang], count:catCount(k.id), bg:IMG(k.img), onClick:(function(id){return function(){c.goCollection(id);};})(k.id) }; });

    // home category showcase sections
    var sectionDefs = [
      { cat:'koltuk', tr:'Koltuk Takımları', en:'Sofa Sets' },
      { cat:'yemek', tr:'Yemek Odası Takımları', en:'Dining Room Sets' },
      { cat:'yatak', tr:'Yatak Odası Takımları', en:'Bedroom Sets' },
      { cat:'kose', tr:'Tamamlayıcı Ürünler', en:'Complementary Pieces' }
    ];
    var homeSections = sectionDefs.map(function (sd, idx) {
      var items = data.products.filter(function(p){return p.cat===sd.cat;}).map(locP);
      var dark = idx % 2 === 1;
      return { cat:sd.cat, title: lang==='tr'?sd.tr:sd.en, kicker: catName(sd.cat), count:items.length, products:items, onAll:(function(id){return function(){c.goCollection(id);};})(sd.cat),
        dark:dark,
        secStyle: dark ? 'background:#15120d' : 'background:#f6f3ed',
        titleColor: dark ? '#ffffff' : '#17140f',
        kickerColor: dark ? accent : accent,
        descColor: dark ? '#b9b1a4' : '#5d564b',
        btnStyle: dark ? 'border:1px solid #3a352e;color:#cabfae' : 'border:1px solid #d3cabb;color:#17140f',
        nameColor: dark ? '#ffffff' : '#17140f' };
    });

    // news + article
    var locN = function (n, i) { return { id:n.id, date:n.date, cat: lang==='tr'?n.catTr:n.catEn, title: lang==='tr'?n.tr:n.en, excerpt: lang==='tr'?n.exTr:n.exEn, bg:IMG(NEWSIMG[i % NEWSIMG.length]), onClick:(function(id){return function(){c.goArticle(id);};})(n.id) }; };
    var newsList = data.news.map(locN);
    var newsTeaser = newsList.slice(0,3);
    var curNIndex = Math.max(0, data.news.map(function(n){return n.id;}).indexOf(s.article));
    var curN = data.news[curNIndex] || data.news[0];
    var article = curN ? {
      title: lang==='tr'?curN.tr:curN.en, date:curN.date, cat: lang==='tr'?curN.catTr:curN.catEn,
      bg:IMG(NEWSIMG[curNIndex % NEWSIMG.length]),
      body: (lang==='tr'?curN.bodyTr:curN.bodyEn || '').split('\n').filter(function(x){return x.trim();}).map(function(p){return {p:p};})
    } : {title:'',date:'',cat:'',bg:'',body:[]};
    var relatedArticles = data.news.filter(function(n){return n.id!==(curN&&curN.id);}).slice(0,3).map(function(n,i){ return locN(n, i+1); });

    // testimonials (müşteri yorumları)
    var testimonials = (data.testimonials || []).map(function (tm) {
      var r = Math.max(0, Math.min(5, tm.rating || 5));
      return { name:tm.name, company:tm.company || '', text: (lang==='tr' ? tm.commentTr : tm.commentEn) || '',
        stars:'★★★★★'.slice(0, r) + '☆☆☆☆☆'.slice(0, 5 - r), initial:(tm.name || '?').charAt(0).toUpperCase(), bg: tm.img ? IMG(tm.img) : '' };
    });
    var hasTestimonials = testimonials.length > 0;

    // dealers
    // Bayiler — il/ilçe filtresi
    var allDealers = data.dealers || [];
    var dIl = s.dealerIl || '', dIlce = s.dealerIlce || '';
    var provSet = {}; allDealers.forEach(function(d){ if(d.province) provSet[d.province]=1; });
    var dealerProvinces = [{v:'',label:(lang==='tr'?'Tüm İller':'All Provinces')}].concat(Object.keys(provSet).sort().map(function(p){return {v:p,label:p};}));
    var distSet = {}; allDealers.forEach(function(d){ if((!dIl || d.province===dIl) && d.district) distSet[d.district]=1; });
    var dealerDistricts = [{v:'',label:(lang==='tr'?'Tüm İlçeler':'All Districts')}].concat(Object.keys(distSet).sort().map(function(p){return {v:p,label:p};}));
    var dealers = allDealers.filter(function(d){ return (!dIl || d.province===dIl) && (!dIlce || d.district===dIlce); }).map(function (d) { return { city:d.city, addr:d.addr, tel:d.tel }; });

    // contact cards
    var contactCards = [
      {label:t.contactPage.phoneL, value:set.phone},
      {label:t.contactPage.emailL, value:set.email},
      {label:t.contactPage.addressL, value: lang==='tr'?set.addressTr:set.addressEn},
      {label:t.contactPage.hoursL, value: lang==='tr'?set.hoursTr:set.hoursEn}
    ];
    var faqSrc = (data.faqs && data.faqs.length) ? data.faqs : (t.faqs||[]);
    var faqItems = faqSrc.map(function (f, i) { var open = s.faqOpen===i; return { q:f.q, a:f.a, open:open, onClick:(function(idx){return function(){c.toggleFaq(idx);};})(i), aStyle:'overflow:hidden;transition:max-height .45s ease,opacity .35s ease,margin .35s ease;max-height:'+(open?'460px':'0')+';opacity:'+(open?1:0)+';margin-top:'+(open?'14px':'0'), iconStyle:'transition:transform .35s ease;display:inline-flex;transform:rotate('+(open?45:0)+'deg)', rowStyle:'border:1px solid '+(open?'#17140f':'#e4ddce')+';background:#fff;border-radius:16px;padding:22px 26px;cursor:pointer;transition:border-color .3s ease' }; });

    // legal
    var lk = s.legal || 'mesafeli';
    var lp = pages[lk] || pages.mesafeli;
    var legalDoc = { title: lang==='tr'?lp.tTr:lp.tEn, sections: parseBody(lang==='tr'?lp.bTr:lp.bEn), updated: lang==='tr'?'Son güncelleme: 06.2026':'Last updated: 06.2026' };
    var legalNav = ['mesafeli','kvkk','gizlilik'].map(function (k) { var pg=pages[k]||{}; return { label: lang==='tr'?pg.tTr:pg.tEn, onClick:(function(kk){return function(){c.goLegal(kk);};})(k), style:'cursor:pointer;padding:13px 16px;border-radius:9px;font-size:15px;font-weight:' + (lk===k?700:500) + ';color:' + (lk===k?'#17140f':'#6b6356') + ';background:' + (lk===k?'#fff':'transparent') + ';border:1px solid ' + (lk===k?'#e6ddcd':'transparent') }; });

    // menus
    var corpMenu = [
      { label: lang==='tr'?'Hakkımızda':'About Us', onClick:c.goCorporate },
      { label: lang==='tr'?'Sosyal Sorumluluk':'Social Responsibility', onClick:c.goCorporate },
      { label: lang==='tr'?'Online Katalog':'Online Catalog', onClick:c.goCatalog },
      { label: lang==='tr'?'Sıkça Sorulan Sorular':'FAQ', onClick:c.goFaq },
      { label: lang==='tr'?pages.mesafeli.tTr:pages.mesafeli.tEn, onClick:c.goMesafeli },
      { label: lang==='tr'?pages.kvkk.tTr:pages.kvkk.tEn, onClick:c.goKvkk }
    ];
    var catMenu = CATS.map(function (k) { return { label:k[lang], count:catCount(k.id), onClick:(function(id){return function(){c.goCollection(id);};})(k.id) }; });
    var megaCols = CATS.map(function (k) {
      return { label:k[lang], count:catCount(k.id), bg:IMG(k.img),
        onHead:(function(id){return function(){c.goCollection(id);};})(k.id),
        items: data.products.filter(function(p){return p.cat===k.id;}).map(function(p){ return { name:p[lang], onClick:(function(id){return function(){c.goProduct(id);};})(p.id) }; }) };
    });

    // footer columns
    var footerCats = CATS.map(function (k) { return { label:k[lang], onClick:(function(id){return function(){c.goCollection(id);};})(k.id) }; });
    var footerCorp = [
      { label: lang==='tr'?'Hakkımızda':'About Us', onClick:c.goCorporate },
      { label: t.nav.news.charAt(0)+t.nav.news.slice(1).toLowerCase(), onClick:c.goNews },
      { label: lang==='tr'?'Bayiler':'Dealers', onClick:c.goDealers },
      { label: lang==='tr'?'SSS':'FAQ', onClick:c.goFaq },
      { label: lang==='tr'?'İletişim':'Contact', onClick:c.goContact }
    ];

    // dinamik menüler (DB'den yönetilir)
    var menuData = data.menu || { header:[], footer:[] };
    var menuAction = function (mi) {
      switch (mi.type) {
        case 'home': return c.goHome;
        case 'corporate': return c.goCorporate;
        case 'collection': return c.goCollectionDefault;
        case 'news': return c.goNews;
        case 'dealers': return c.goDealers;
        case 'contact': return c.goContact;
        case 'faq': return c.goFaq;
        case 'category': return (function(v){ return function(){ c.goCollection(v); }; })(mi.value);
        case 'page': return (function(v){ return function(){ c.goLegal(v); }; })(mi.value);
        case 'url': return (function(v){ return function(){ if(v) window.location.href = v; }; })(mi.value);
        default: return function(){};
      }
    };
    var menuActive = function (mi) {
      switch (mi.type) {
        case 'home': return page==='home';
        case 'corporate': return page==='corporate';
        case 'collection': return page==='collection';
        case 'news': return page==='news' || page==='article';
        case 'dealers': return page==='dealers';
        case 'contact': return page==='contact';
        case 'faq': return page==='faq';
        default: return false;
      }
    };
    var headerMenu = (menuData.header || []).map(function (mi) {
      return { label: lang==='tr'?mi.labelTr:mi.labelEn, onClick: menuAction(mi), style: link(menuActive(mi)),
        isCorp: mi.type==='corporate', isMega: mi.type==='collection',
        isPlain: mi.type!=='corporate' && mi.type!=='collection' };
    });
    var footerMenu = (menuData.footer || []).map(function (mi) {
      return { label: lang==='tr'?mi.labelTr:mi.labelEn, onClick: menuAction(mi) };
    });
    // Menü boşsa eski sabit footer linklerine düş
    if (!footerMenu.length) footerMenu = footerCorp;

    // search
    var q = (s.query || '').trim().toLowerCase();
    var results = q ? data.products.filter(function (p) { return p[lang].toLowerCase().indexOf(q)>=0 || p.tr.toLowerCase().indexOf(q)>=0 || p.en.toLowerCase().indexOf(q)>=0; }).map(locP) : [];

    var stats = lang==='tr'
      ? [{n:'35+',l:'yıllık tecrübe',count:35,suffix:'+'},{n:'140+',l:'kalifiye çalışan',count:140,suffix:'+'},{n:'40+',l:'ülkeye ihracat',count:40,suffix:'+'}]
      : [{n:'35+',l:'years of experience',count:35,suffix:'+'},{n:'140+',l:'qualified employees',count:140,suffix:'+'},{n:'40+',l:'countries exported',count:40,suffix:'+'}];

    // mobile menu
    var mobileLinks = [
      {label:t.nav.home, onClick:c.goHome, active:page==='home'},
      {label:t.nav.corporate, onClick:c.goCorporate, active:page==='corporate'},
      {label:t.nav.collection, onClick:c.goCollectionDefault, active:page==='collection'||page==='product'},
      {label:t.nav.news, onClick:c.goNews, active:page==='news'||page==='article'},
      {label:t.nav.dealers, onClick:c.goDealers, active:page==='dealers'},
      {label:t.nav.contact, onClick:c.goContact, active:page==='contact'}
    ].map(function (it, i) { return { label:it.label, onClick:it.onClick, num:('0'+(i+1)).slice(-2),
      style:'display:flex;align-items:baseline;gap:20px;cursor:pointer;opacity:0;animation:awaUp .55s cubic-bezier(.2,.7,.2,1) forwards;animation-delay:'+(90+i*65)+'ms;color:'+(it.active?accent:'#f6f3ed')+';font-family:Archivo;font-weight:800;font-size:clamp(30px,9vw,40px);letter-spacing:-.02em;padding:14px 0;border-bottom:1px solid rgba(255,255,255,.09)',
      numStyle:"font-family:'Space Mono';font-size:13px;color:"+accent }; });
    var mobileCats = CATS.map(function (k, i) { return { label:k[lang], onClick:(function(id){return function(){c.goCollection(id);};})(k.id), style:'cursor:pointer;padding:10px 16px;border:1px solid rgba(255,255,255,.22);border-radius:999px;color:#d8cfc0;font-size:13px;font-family:Archivo;font-weight:600;opacity:0;animation:awaUp .55s ease forwards;animation-delay:'+(430+i*55)+'ms' }; });

    // SEO meta
    var ttlBase = lang==='tr'?set.seoTitleTr:set.seoTitleEn;
    var titleMap = {
      home:ttlBase, corporate:t.nav.corporate.charAt(0)+t.nav.corporate.slice(1).toLowerCase()+' — AWA Mobilya',
      collection:catName(curCat)+' — AWA Mobilya', product:curP[lang]+' — AWA Mobilya',
      news:(lang==='tr'?'Haberler':'News')+' — AWA Mobilya', article:(article.title||'')+' — AWA Mobilya',
      contact:(lang==='tr'?'İletişim':'Contact')+' — AWA Mobilya', dealers:t.dealersPage.title+' — AWA Mobilya',
      legal:legalDoc.title+' — AWA Mobilya', faq:t.faqPage.title+' — AWA Mobilya', admin:'Yönetim Paneli — AWA Mobilya'
    };
    setMeta(titleMap[page] || ttlBase, lang==='tr'?set.seoDescTr:set.seoDescEn, lang, {keywords:set.seoKeywords, ogImage:set.ogImage, favicon:set.favicon});

    // admin
    var adminInput = 'width:100%;background:#0f0e0c;border:1px solid #38332b;border-radius:8px;padding:11px 13px;color:#ece6da;font-size:14px;outline:none';
    var tab = s.adminTab;
    var tabStyle = function (k) { return 'cursor:pointer;display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-radius:9px;margin-bottom:4px;font-weight:600;font-size:14px;color:' + (tab===k?'#fff':'#9a8f7e') + ';background:' + (tab===k?'#262320':'transparent'); };
    var adminTabs = [
      { id:'dashboard', label:t.admin.dashboard, count:'', onClick:function(){c.setAdminTab('dashboard');}, style:tabStyle('dashboard') },
      { id:'slides', label:t.admin.slides, count:slides.length, onClick:function(){c.setAdminTab('slides');}, style:tabStyle('slides') },
      { id:'products', label:t.admin.products, count:data.products.length, onClick:function(){c.setAdminTab('products');}, style:tabStyle('products') },
      { id:'categories', label:t.admin.categories, count:CATS.length, onClick:function(){c.setAdminTab('categories');}, style:tabStyle('categories') },
      { id:'news', label:t.admin.news, count:data.news.length, onClick:function(){c.setAdminTab('news');}, style:tabStyle('news') },
      { id:'dealers', label:t.admin.dealers, count:data.dealers.length, onClick:function(){c.setAdminTab('dealers');}, style:tabStyle('dealers') },
      { id:'pages', label:t.admin.pages, count:3, onClick:function(){c.setAdminTab('pages');}, style:tabStyle('pages') },
      { id:'seo', label:t.admin.seo, count:'', onClick:function(){c.setAdminTab('seo');}, style:tabStyle('seo') },
      { id:'general', label:t.admin.general, count:'', onClick:function(){c.setAdminTab('general');}, style:tabStyle('general') },
      { id:'email', label:t.admin.email, count:'', onClick:function(){c.setAdminTab('email');}, style:tabStyle('email') }
    ];
    var adminStats = [
      { label:t.admin.products, n:data.products.length, onClick:function(){c.setAdminTab('products');} },
      { label:t.admin.categories, n:CATS.length, onClick:function(){c.setAdminTab('categories');} },
      { label:t.admin.news, n:data.news.length, onClick:function(){c.setAdminTab('news');} },
      { label:t.admin.dealers, n:data.dealers.length, onClick:function(){c.setAdminTab('dealers');} },
      { label:t.admin.slides, n:slides.length, onClick:function(){c.setAdminTab('slides');} }
    ];
    var dashRecent = data.news.slice(0,4).map(function (n) { return { title: lang==='tr'?n.tr:n.en, date:n.date, cat: lang==='tr'?n.catTr:n.catEn, onClick:(function(id){return function(){c.setAdminTab('news');};})(n.id) }; });
    var dashShortcuts = [
      { label:t.admin.addProduct, onClick:c.addProduct },
      { label:t.admin.addCategory, onClick:c.addCategory },
      { label:t.admin.addNews, onClick:c.addNews },
      { label:t.admin.addDealer, onClick:c.addDealer }
    ];
    var productOptions = data.products.map(function (p) { return { id:p.id, label:p[lang] }; });
    var adminSlides = slides.map(function (sl) { return {
      id:sl.id, onEdit:(function(id){return function(){c.editRecord(id);};})(sl.id),
      img:sl.img, subTr:sl.subTr, subEn:sl.subEn, productId:sl.productId, thumb:IMG(sl.img),
      onImg:(function(id){return function(e){c.updSlide(id,'img',e.target.value);};})(sl.id),
      onSubTr:(function(id){return function(e){c.updSlide(id,'subTr',e.target.value);};})(sl.id),
      onSubEn:(function(id){return function(e){c.updSlide(id,'subEn',e.target.value);};})(sl.id),
      onProduct:(function(id){return function(e){c.updSlide(id,'productId',e.target.value);};})(sl.id),
      onFile:(function(id){return function(e){c.readFile(e,function(v){c.updSlide(id,'img',v);});};})(sl.id),
      onDel:(function(id){return function(){c.delSlide(id);};})(sl.id)
    }; });
    var catOptions = CATS.map(function (k) { return { id:k.id, label:k[lang] }; });
    var imageOptions = IMAGES.map(function (im, i) { return { v:im, label:'Görsel '+(i+1) }; });
    var adminCategories = CATS.map(function (k) { return {
      id:k.id, onEdit:(function(id){return function(){c.editRecord(id);};})(k.id),
      tr:k.tr, en:k.en, img:k.img, dTr:k.dTr, dEn:k.dEn, thumb:IMG(k.img), count:data.products.filter(function(p){return p.cat===k.id;}).length,
      onTr:(function(id){return function(e){c.updCategory(id,'tr',e.target.value);};})(k.id),
      onEn:(function(id){return function(e){c.updCategory(id,'en',e.target.value);};})(k.id),
      onImg:(function(id){return function(e){c.updCategory(id,'img',e.target.value);};})(k.id),
      onFile:(function(id){return function(e){c.readFile(e,function(v){c.updCategory(id,'img',v);});};})(k.id),
      onDTr:(function(id){return function(e){c.updCategory(id,'dTr',e.target.value);};})(k.id),
      onDEn:(function(id){return function(e){c.updCategory(id,'dEn',e.target.value);};})(k.id),
      onDel:(function(id){return function(){c.delCategory(id);};})(k.id)
    }; });
    var adminProducts = data.products.map(function (p) { return {
      id:p.id, onEdit:(function(id){return function(){c.editRecord(id);};})(p.id), catName:catName(p.cat),
      tr:p.tr, en:p.en, cat:p.cat, img:p.img, thumb:IMG(p.img),
      onTr:(function(id){return function(e){c.updProduct(id,'tr',e.target.value);};})(p.id),
      onEn:(function(id){return function(e){c.updProduct(id,'en',e.target.value);};})(p.id),
      onCat:(function(id){return function(e){c.updProduct(id,'cat',e.target.value);};})(p.id),
      onImg:(function(id){return function(e){c.updProduct(id,'img',e.target.value);};})(p.id),
      onFile:(function(id){return function(e){c.readFile(e,function(v){c.updProduct(id,'img',v);});};})(p.id),
      onDel:(function(id){return function(){c.delProduct(id);};})(p.id)
    }; });
    var adminNews = data.news.map(function (n) { return {
      id:n.id, onEdit:(function(id){return function(){c.editRecord(id);};})(n.id),
      date:n.date, catTr:n.catTr, catEn:n.catEn, tr:n.tr, en:n.en, exTr:n.exTr, exEn:n.exEn, bodyTr:n.bodyTr, bodyEn:n.bodyEn,
      onDate:(function(id){return function(e){c.updNews(id,'date',e.target.value);};})(n.id),
      onCatTr:(function(id){return function(e){c.updNews(id,'catTr',e.target.value);};})(n.id),
      onCatEn:(function(id){return function(e){c.updNews(id,'catEn',e.target.value);};})(n.id),
      onTr:(function(id){return function(e){c.updNews(id,'tr',e.target.value);};})(n.id),
      onEn:(function(id){return function(e){c.updNews(id,'en',e.target.value);};})(n.id),
      onExTr:(function(id){return function(e){c.updNews(id,'exTr',e.target.value);};})(n.id),
      onExEn:(function(id){return function(e){c.updNews(id,'exEn',e.target.value);};})(n.id),
      onBodyTr:(function(id){return function(e){c.updNews(id,'bodyTr',e.target.value);};})(n.id),
      onBodyEn:(function(id){return function(e){c.updNews(id,'bodyEn',e.target.value);};})(n.id),
      onDel:(function(id){return function(){c.delNews(id);};})(n.id)
    }; });
    var adminDealers = data.dealers.map(function (d) { return {
      id:d.id, onEdit:(function(id){return function(){c.editRecord(id);};})(d.id),
      city:d.city, addr:d.addr, tel:d.tel,
      onCity:(function(id){return function(e){c.updDealer(id,'city',e.target.value);};})(d.id),
      onAddr:(function(id){return function(e){c.updDealer(id,'addr',e.target.value);};})(d.id),
      onTel:(function(id){return function(e){c.updDealer(id,'tel',e.target.value);};})(d.id),
      onDel:(function(id){return function(){c.delDealer(id);};})(d.id)
    }; });
    var adminPages = ['mesafeli','kvkk','gizlilik'].map(function (k) { var pg=pages[k]||{}; return {
      id:k, onEdit:(function(kk){return function(){c.editRecord(kk);};})(k),
      key:k, tTr:pg.tTr, tEn:pg.tEn, bTr:pg.bTr, bEn:pg.bEn,
      onTTr:(function(kk){return function(e){c.updPage(kk,'tTr',e.target.value);};})(k),
      onTEn:(function(kk){return function(e){c.updPage(kk,'tEn',e.target.value);};})(k),
      onBTr:(function(kk){return function(e){c.updPage(kk,'bTr',e.target.value);};})(k),
      onBEn:(function(kk){return function(e){c.updPage(kk,'bEn',e.target.value);};})(k)
    }; });

    var R = window.React;
    var _eid = s.adminEditId;
    var _find = function(arr){ for(var i=0;i<arr.length;i++){ if(arr[i].id===_eid) return arr[i]; } return null; };
    var editProduct = _find(adminProducts), editCategory = _find(adminCategories), editNews = _find(adminNews), editDealer = _find(adminDealers), editSlide = _find(adminSlides), editPage = _find(adminPages);
    var brandMark = set.logo
      ? R.createElement('img', { src:set.logo, alt:(set.brandTr||'AWA')+' '+(set.brandSub||''), style:{height:'38px',width:'auto',display:'block'} })
      : R.createElement('span', { style:{display:'flex',alignItems:'baseline',gap:'9px'} },
          R.createElement('span', { style:{fontFamily:'Archivo',fontWeight:900,fontSize:'29px',letterSpacing:'-.04em',color:navColor} }, set.brandTr||'AWA'),
          R.createElement('span', { style:{fontFamily:'Archivo',fontWeight:500,fontSize:'11px',letterSpacing:'.42em',color:navColor,opacity:.55} }, set.brandSub||'MOBİLYA')
        );
    return {
      t:t, accent:accent, kickerStyle:kickerStyle, headerStyle:headerStyle, navColor:navColor, brandMark:brandMark,
      goHome:c.goHome, goCorporate:c.goCorporate, goNews:c.goNews, goContact:c.goContact, goDealers:c.goDealers,
      goCollectionDefault:c.goCollectionDefault, goCollectionCurrent:c.goCollectionCurrent, goCatalog:c.goCatalog,
      goMesafeli:c.goMesafeli, goKvkk:c.goKvkk, goAdmin:c.goAdmin,
      openCorp:c.openCorp, openCol:c.openCol, closeDrop:c.closeDrop,
      corpOpen:s.dropdown==='corp', colOpen:s.dropdown==='col', corpMenu:corpMenu, catMenu:catMenu, megaCols:megaCols,
      toggleSearch:c.toggleSearch, searchOpen:s.searchOpen, setQuery:c.setQuery, query:s.query,
      hasResults: q.length>0 && results.length>0, noResults: q.length>0 && results.length===0, searchResults:results,
      setTR:c.setTR, setEN:c.setEN, trStyle:langStyle(lang==='tr'), enStyle:langStyle(lang==='en'),
      navHomeStyle:link(page==='home'), navCorpStyle:link(page==='corporate'), navColStyle:link(page==='collection'||page==='product'),
      navNewsStyle:link(page==='news'||page==='article'), navDealersStyle:link(page==='dealers'), navContactStyle:link(page==='contact'),
      isHome:page==='home', isCorporate:page==='corporate', isCollection:page==='collection', isProduct:page==='product',
      isNews:page==='news', isArticle:page==='article', isContact:page==='contact', isDealers:page==='dealers', isLegal:page==='legal', isAdmin:page==='admin', isFaq:page==='faq',
      adminAuthed:s.adminAuthed, adminLocked: page==='admin' && !s.adminAuthed, adminPwd:s.adminPwd, adminErr:s.adminErr, setAdminPwd:c.setAdminPwd, submitAdminPwd:c.submitAdminPwd, adminLogout:c.adminLogout,
      goFaq:c.goFaq, faqItems:faqItems, faqKicker:t.faqPage.kicker, faqTitle:t.faqPage.title, faqIntro:t.faqPage.intro,
      lightboxOpen:s.lightboxOpen, lightboxBg:IMG(galArr[gi]), lightboxImg:galArr[gi], closeLightbox:c.closeLightbox, downloadImg:c.downloadImg, lbHasMany:galArr.length>1, lbNext:c.lbNext, lbPrev:c.lbPrev, lbIndex:(gi+1)+' / '+galArr.length,
      cookieShow: !s.cookieSeen && page!=='admin', acceptCookies:c.acceptCookies, rejectCookies:c.rejectCookies,
      cookieTitle: lang==='tr'?'Çerez Tercihleri':'Cookie Preferences',
      cookieText: lang==='tr'?'Web sitemizde size daha iyi bir deneyim sunmak için çerezler kullanıyoruz. Detaylar için Gizlilik Politikamızı inceleyebilirsiniz.':'We use cookies to give you a better experience on our website. See our Privacy Policy for details.',
      cookieAccept: lang==='tr'?'Kabul Et':'Accept', cookieReject: lang==='tr'?'Reddet':'Reject', cookieMore: lang==='tr'?'Gizlilik Politikası':'Privacy Policy', goGizlilik:function(){c.goLegal('gizlilik');},
      sortMode:sortMode, sortOptions:sortOptions, setSort:c.setSort,
      heroSlidesAll:heroSlidesAll, heroTrackStyle:heroTrackStyle, heroNext:c.heroNext, heroPrev:c.heroPrev,
      gFeatured:M?'1fr':'1fr 1.18fr', gAbout:M?'1fr':'.9fr 1.1fr', gCatalog:M?'1fr':'1fr 1.15fr', gCat:M?'1fr':'1fr 1fr', g3:M?'1fr':'repeat(3,1fr)', g2:M?'1fr':'1fr 1fr', gProduct:M?'1fr':'1.05fr .95fr', gContact:M?'1fr':'1.1fr .9fr', gFooter:M?'1fr 1fr':'1.4fr .8fr .8fr 1.3fr',
      showFooter: page!=='admin', showCatalog: set.homeCatalog !== '0',
      isMobile:s.isMobile, isDesktop:!s.isMobile, mobileOpen:s.mobileOpen, toggleMobile:c.toggleMobile, closeMobile:c.closeMobile, mobileLinks:mobileLinks, mobileCats:mobileCats,
      trMStyle:'cursor:pointer;color:#fff;opacity:'+(lang==='tr'?1:.4), enMStyle:'cursor:pointer;color:#fff;opacity:'+(lang==='en'?1:.4),
      heroBg:IMG(hs.img), heroSub: lang==='tr'?hs.subTr:hs.subEn, heroTitle:hp[lang], heroCta:(function(id){return function(){c.goProduct(id);};})(hs.productId), heroDots:heroDots, goHero:c.goHero,
      stats:stats, aboutText: lang==='tr'?set.aboutTr:set.aboutEn,
      scriptAbout: lang==='tr'?'zamansız zarafet':'timeless elegance', scriptFeatured: lang==='tr'?'el emeğiyle':'handcrafted with care', scriptContact: lang==='tr'?'bize ulaşın':'say hello',
      catCards:catCards, newsTeaser:newsTeaser, newsList:newsList, homeSections:homeSections,
      testimonials:testimonials, hasTestimonials:hasTestimonials,
      testiKicker: lang==='tr'?'MÜŞTERİLERİMİZ':'TESTIMONIALS',
      testiTitle: lang==='tr'?'Bizimle çalışanlar ne diyor?':'What our partners say',
      showTestimonials: hasTestimonials && set.homeTestimonials !== '0',
      showCollections: set.homeCollections !== '0',
      showNews: set.homeNews !== '0',
      collectionTitle:catName(curCat), collectionDesc:catDesc(curCat), collectionCount:filtered.length, catTabs:catTabs, filteredProducts:filtered, collectionHeroBg:IMG((CATS.filter(function(k){return k.id===curCat;})[0]||CATS[0]).img),
      product:product, productFeatures:productFeatures, productPieces:productPieces, relatedProducts:related, gallery:gallery,
      galSlides:galSlides, galTrackStyle:galTrackStyle, galDots:galDots,
      article:article, relatedArticles:relatedArticles,
      dealers:dealers, contactCards:contactCards,
      dealerProvinces:dealerProvinces, dealerDistricts:dealerDistricts, dealerIl:dIl, dealerIlce:dIlce, setDealerIl:c.setDealerIl, setDealerIlce:c.setDealerIlce,
      legalDoc:legalDoc, legalNav:legalNav,
      phone:set.phone, email:set.email, address: lang==='tr'?set.addressTr:set.addressEn, hours: lang==='tr'?set.hoursTr:set.hoursEn,
      footerCats:footerCats, footerCorp:footerCorp, headerMenu:headerMenu, footerMenu:footerMenu, hasHeaderMenu:headerMenu.length>0,
      sent:s.sent, notSent:!s.sent, subscribed:s.subscribed, notSubscribed:!s.subscribed,
      sendForm:c.sendForm, subscribe:c.subscribe,
      resetData:c.resetData, adminTabs:adminTabs, adminInput:adminInput, productOptions:productOptions, catOptions:catOptions, imageOptions:imageOptions,
      tabDashboard:tab==='dashboard', tabSlides:tab==='slides', tabProducts:tab==='products', tabCategories:tab==='categories', tabNews:tab==='news', tabDealers:tab==='dealers', tabPages:tab==='pages', tabSeo:tab==='seo', tabGeneral:tab==='general', tabEmail:tab==='email',
      adminStats:adminStats, dashRecent:dashRecent, dashShortcuts:dashShortcuts,
      adminListing:!s.adminEditId, adminEditing:!!s.adminEditId, editRecord:c.editRecord, closeEdit:c.closeEdit,
      editProduct:editProduct, editCategory:editCategory, editNews:editNews, editDealer:editDealer, editSlide:editSlide, editPage:editPage,
      adminSlides:adminSlides, adminProducts:adminProducts, adminCategories:adminCategories, adminNews:adminNews, adminDealers:adminDealers, adminPages:adminPages,
      addSlide:c.addSlide, addProduct:c.addProduct, addCategory:c.addCategory, addNews:c.addNews, addDealer:c.addDealer,
      brandName: lang==='tr'?(set.brandTr||'AWA'):(set.brandTr||'AWA'), logo:set.logo, hasLogo:!!set.logo,
      setPhone:set.phone, onPhone:function(e){c.updSetting('phone',e.target.value);},
      setEmail:set.email, onEmail:function(e){c.updSetting('email',e.target.value);},
      setAddressTr:set.addressTr, onAddressTr:function(e){c.updSetting('addressTr',e.target.value);},
      setAddressEn:set.addressEn, onAddressEn:function(e){c.updSetting('addressEn',e.target.value);},
      setHoursTr:set.hoursTr, onHoursTr:function(e){c.updSetting('hoursTr',e.target.value);},
      setHoursEn:set.hoursEn, onHoursEn:function(e){c.updSetting('hoursEn',e.target.value);},
      setAboutTr:set.aboutTr, onAboutTr:function(e){c.updSetting('aboutTr',e.target.value);},
      setAboutEn:set.aboutEn, onAboutEn:function(e){c.updSetting('aboutEn',e.target.value);},
      setSeoTitleTr:set.seoTitleTr, onSeoTitleTr:function(e){c.updSetting('seoTitleTr',e.target.value);},
      setSeoTitleEn:set.seoTitleEn, onSeoTitleEn:function(e){c.updSetting('seoTitleEn',e.target.value);},
      setSeoDescTr:set.seoDescTr, onSeoDescTr:function(e){c.updSetting('seoDescTr',e.target.value);},
      setSeoDescEn:set.seoDescEn, onSeoDescEn:function(e){c.updSetting('seoDescEn',e.target.value);},
      setSeoKeywords:set.seoKeywords, onSeoKeywords:function(e){c.updSetting('seoKeywords',e.target.value);},
      setOgImage:set.ogImage, onOgImage:function(e){c.updSetting('ogImage',e.target.value);}, onOgImageFile:function(e){c.readFile(e,function(v){c.updSetting('ogImage',v);});},
      setLogo:set.logo, logoThumb:set.logo?IMG(set.logo):'', onLogoFile:function(e){c.readFile(e,function(v){c.updSetting('logo',v);});}, clearLogo:function(){c.updSetting('logo','');},
      setFavicon:set.favicon, faviconThumb:set.favicon?IMG(set.favicon):'', onFaviconFile:function(e){c.readFile(e,function(v){c.updSetting('favicon',v);});}, clearFavicon:function(){c.updSetting('favicon','');},
      setBrandTr:set.brandTr, onBrandTr:function(e){c.updSetting('brandTr',e.target.value);},
      setBrandSub:set.brandSub, onBrandSub:function(e){c.updSetting('brandSub',e.target.value);},
      setMailRecipient:set.mailRecipient, onMailRecipient:function(e){c.updSetting('mailRecipient',e.target.value);},
      setMailSender:set.mailSender, onMailSender:function(e){c.updSetting('mailSender',e.target.value);},
      setSmtpHost:set.smtpHost, onSmtpHost:function(e){c.updSetting('smtpHost',e.target.value);},
      setSmtpPort:set.smtpPort, onSmtpPort:function(e){c.updSetting('smtpPort',e.target.value);},
      setSmtpUser:set.smtpUser, onSmtpUser:function(e){c.updSetting('smtpUser',e.target.value);},
      setSmtpPass:set.smtpPass, onSmtpPass:function(e){c.updSetting('smtpPass',e.target.value);},
      setSmtpSecure:set.smtpSecure, onSmtpSecure:function(e){c.updSetting('smtpSecure',e.target.value);},
      brandLogo:set.logo||'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==', brandHasLogo:!!set.logo, brandNoLogo:!set.logo, brandTr:set.brandTr||'AWA', brandSub:set.brandSub||'MOBİLYA'
    };
  }

  return { defaultData: defaultData, buildVM: buildVM };
})();
