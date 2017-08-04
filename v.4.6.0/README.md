###### 29 Ekim 2016 Cumartesi - Duyuru;
tiyse template engine kullanmaya hemen başlayabilirsiniz. Kendi iş çözümlerinizi ve bizden talep edilen isteklerinize hızlı şekilde cevap vereceğimize emin olabilirsiniz.

# Tiyse Template Engine v.4.6.0
Merhaba, geliştiriciler tiyse tema motoru'nu geliştirmemin sebebi az kod çok iş ve karmaşanın engellenmesi için hazırlamış olduğum bir şablon yöntetim sistemidir.

Oldukça başarılı hızlı bir yapıya sahip ayrıca alt yapılandırması ileriye yönelik stabil ve geliştirilebilir çalışmaktadır. Majör, Minor, Bug Fix, Build... gibi değişimleri version üzerinden belirtilecektir.

Sınıf dosyasında değişiklik yapmaz iseniz güncellemeleri sorunsuz yapabilirsiniz. Geliştirme esnasında mevcut fonksiyonu modellerken kullanabileceğiniz veya kullanmış olduğunuz yapıya göre güncellemeleri sağlayacağım.

### SINIF ÖZELLİKLERİ
<ul>
  <li>ZLIB sıkıştırma algoritması</li>
  <li>Kaynak kod sıkıştırma</li>
  <li>Sıkıştırılmış önbellekleme</li>
  <li>Şablon değiştirici ve operasyon</li>
  <li>Stabil, performans ve hız</li>
</ul>

### KURULUM
```php
<?php

include_once( __DIR__ ."/tiyse.tpl.class.php");

// tiyse sınıf
$tiyse = new tiyse();

// değişken
$tiyse->assign("{title}","Merhaba Dünyalı!");

// tema dosyası
$tiyse->draw("main",600);

?>
```

### FONKSİYONLAR

```php
<?php

// şablon ayarı
$tiyse = new tiyse(array(
  'cache_dir' => '/cache/',
  'tpl_dir'   => '/templates/Default/',
  'tpl_ext'   => 'tpl'
));

// etiket değiştirmek isterseniz
$tiyse->assign("{title}","Merhaba Dünyalı!");

// önbellek oluşturmak isterseniz
$tiyse->draw("main",600);

// önbellek kullanmak istemezseniz
$tiyse->draw("main");

?>
```

### ETİKETLER

<ul>
  <li>{value}</li>
  <li>{function="funcname()"}</li>
  <li>{include="filename"}</li>
  <li>{if="condition"} test {/endif}</li>
  <li>{if="condition"} test 0 {/else} test 1 {/endif}</li>
  <li>{if="condition"} test 0 {elseif="condition"} test 1 {/else} test 2 {/endif}</li>
  <li>{loop=""} {key} {value} {/loop}</li>
</ul>

```html
<!DOCTYPE html>
<html lang="tr">
	<head>
		<title>{title}</title>
		<meta charset="utf-8" />
	</head>
<body>
  <!--/ değişken çağırma /-->
  {content}
  
  <!-- fonksiyon çağırabilirsiniz veya $tiyse->assign("{content}",'{function="funcname()"}'); -->
  {function="funcname()"}
  
  <!--/ tema dosyası çağırma /-->
  {include="main"}
  
  <!--/ if kullanımı /-->
  {if="5 == 5"} test {/endif}
  
  <!--/ if - else kullanımı /-->
  {if="5 == 5"}
  	test 0
  {/else}
  	test 1
  {/endif}
  
  <!--/ if - else - elseif - endif kullanımı /-->
  {if="5 == 5"}
  	 test 0
  {elseif="5 == 6"}
  	test 1
  {/else}
  	test 2
  {/endif}
  
  <!--/ dizi listeleme /-->
  {loop="array"}
  	{key} {value}
  {/loop}
</body>
</html>
```

### KONFİGRASYON
```php
<?php

$tiyse = new tiyse(array(
  // şablon önbellek klasörü
  'cache_dir' => '/cache/',
  // şablon klasörü
  'tpl_dir'   => '/templates/Default/',
  // şablon dosya uzantısı
  'tpl_ext'   => 'tpl'
));

?>
```

### GÜNCELLEMELER

<ul>
  <li>Önbellek klasör belirleme</li>
  <li>Şablon klasör belirleme</li>
  <li>Şablon dosya uzantısı belirleme</li>
  <li>Şablon ve önbellek dosyası veya klasörü hata bildirimi</li>
</ul>
