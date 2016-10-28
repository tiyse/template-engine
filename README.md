###### 28 Ekim 2016 Cuma - Duyuru;
İlk yayın sürecinde olduğumuz için sınıfımızı test edin ve deneyin. Test sürüm tamamlandığında bu alan üzerinden bilgilendirme sağlanacaktır. Bizi tercih ettiğiniz için teşekkür ederiz.

# Tiyse Template Engine v.3.0.0 Release
Merhaba, geliştiriciler tiyse tema motorunu geliştirmemin sebebi az kod çok iş ve karmaşanın engellenmesi algoritmik bir yapının kullananılması için hazırlamış olduğum bir operasyon yöntetim sistemidir.

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
$tiyse->draw("main");

?>
```

### KULLANIM

<ul>
  <li>{value}</li>
  <li>{function="funcname()"}</li>
  <li>{include="filename"}</li>
  <li>{if=""} test {/endif}</li>
  <li>{if=""} test 0 {/else} test 1 {/endif}</li>
  <li>{if=""} test 0 {elseif=""} test 1 {/else} test 2 {/endif}</li>
  <li>{loop=""} {key} {value} {/loop}</li>
</ul>

```php
// değişken => atanan değer
$tiyse->assign("{title}",'Başlık');
$tiyse->assign("{content}","İçerik");
```

```html
<!DOCTYPE html>
<html lang="tr">
	<head>
		<title>{title}</title>
		<meta charset="utf-8" />
	</head>
<body>
  <!-- değişken çağırma -->
  {content}
  
  <!-- tema dosyası çağırma -->
  {include="main"}
  
  <!-- if -->
  {if="5 == 5"} test {/endif}
  
  <!-- if - else -->
  {if="5 == 5"}
  	test 0
  {/else}
  	test 1
  {/endif}
  
  <!-- if - else - elseif - endif -->
  {if="5 == 5"}
  	 test 0
  {elseif="5 == 5"}
  	test 1
  {/else}
  	test 2
  {/endif}
</body>
</html>
```
