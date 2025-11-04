# Event Manager Zadatak 2

PHP projekt za upravljanje događajima i njihovim terminima.

---

## 🚀 Funkcionalnosti

- Kreiranje događaja s nazivom, lokacijom, minimalnim i maksimalnim brojem karata po korisniku.
- Dodavanje termina za događaje.
- Uređivanje termina s **optimistic locking** kako bi se izbjegli konflikti pri istovremenim izmjenama.
- Pregled svih događaja i termina u preglednoj tablici.
- Status termina:  
  - **Upcoming** – budući termini (zeleno)  
  - **Ongoing** – trenutno aktivni termini (narančasto)  
  - **Past** – prošli termini (sivo)
- Prikaz trajanja termina (sati i minute).
- Minimalni i pregledni dizajn pomoću CSS-a.

---

## Tehnologije

- PHP 7+  
- MySQL / MariaDB  
- HTML, CSS (minimalni, pregledni stilovi)  
- XAMPP (lokalni server za pokretanje projekta)

---

##  Struktura projekta

event_manager/
│
├── db.php # PDO konekcija s bazom
├── index.php # Pregled svih događaja i termina
├── create_event.php # Forma za kreiranje događaja
├── create_session.php # Forma za dodavanje termina
├── edit_session.php # Uređivanje termina s optimistic locking
├── style.css # Minimalni CSS za preglednost i status boje
└── sql_setup.sql # SQL skripta za kreiranje baze i tablica


---

## Setup

1. Instaliraj [XAMPP](https://www.apachefriends.org/index.html).  
2. Pokreni **Apache** 
3. Kopiraj cijeli projekt u `htdocs` folder XAMPP-a, npr.:


C:\xampp\htdocs\event_manager\

4. Importaj `sql_setup.sql` u MySQL (možeš koristiti **phpMyAdmin** ili `mysql` CLI):
```sql
mysql -u root -p < sql_setup.sql


Prilagodi db.php s tvojim MySQL podacima ako je potrebno.

Otvori preglednik i posjeti:

http://localhost/event_manager/index.php


Kreiraj događaje i dodaj termine putem web sučelja.

## Napomene

Validacija: Min tickets ≤ Max tickets i Start < End za termine.

Optimistic Locking: Ako netko drugi istovremeno uređuje isti termin, sustav javlja konflikt.

Preglednost: Tablice su obojane prema statusu termina, a trajanje termina se prikazuje u satima i minutama.
