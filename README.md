# PHPkoru Firewall

## Dil: Türkçe

PHPkoru Firewall - Katman 7 DoS / DDoS için Basit Güvenlik Duvarı

### Özet
PHPkoru Firewall, php sayfalarınıza gelebilecek Katman 7 DoS / DDoS saldırılarından sizi korur veya saldırının etkisini azaltır. Bu sayede kaynak kullanımını saldırı anında korur.

### Özellikler
- Açık kaynak
- Tam optimize edildi
- İstemci ve php taraflı. Oturumlar (session) yok, sadece çerezler kullanılır.

### Nasıl kullanılır

Katman 7 DoS / DDoS saldırılarından korumak istediğiniz PHP sayfalarının en üstüne aşağıdaki dosyayı dahil edin.
```
<?php
include_once __DIR__."/phpkoru-firewall.php";
?>
```

# PHPkoru Firewall

## Language: English

PHPkoru Firewall - Basic Firewall for Layer 7 DoS / DDoS

### Summary
PHPkoru Firewall, protects you from Layer 7 DoS / DDoS attacks that can happen to your php pages or reduces the effect of the attack. In this way, it protects the resource usage during the attack.

### Features
- Open source
- Full optimized
- Client and php side. No sessions, only cookies.

### How to use

Include the following file at the top of the PHP pages you want to protect for Layer 7 DoS / DDoS attacks.
```
<?php
include_once __DIR__."/phpkoru-firewall.php";
?>
```