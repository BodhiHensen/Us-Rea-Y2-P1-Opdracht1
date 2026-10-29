# Database Specificatie Tabel - Magazijn Jamin

## 1. Product (Stamtabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van het product |
| `Naam` | VARCHAR(50) | Nee | - | - | Naam van het product |
| `Barcode` | VARCHAR(20) | Nee | - | - | Unieke barcode van het product |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |

---

## 2. Allergeen (Stamtabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van het allergeen |
| `Naam` | VARCHAR(50) | Nee | - | - | Naam van de allergeen stof |
| `Omschrijving` | VARCHAR(255) | Nee | - | - | Beschrijving van het allergeen effect |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |

---

## 3. Leverancier (Stamtabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van de leverancier |
| `Naam` | VARCHAR(50) | Nee | - | - | Bedrijfsnaam leverancier |
| `ContactPersoon` | VARCHAR(50) | Nee | - | - | Naam contactpersoon |
| `LeverancierNummer` | VARCHAR(20) | Nee | - | - | Uniek leveranciernummer (bijv. L1029384719) |
| `Mobiel` | VARCHAR(15) | Nee | - | - | Mobiel telefoonnummer |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |

---

## 4. Magazijn (Koppeltabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van voorraadrecord |
| `ProductId` | SMALLINT UNSIGNED | Nee | - | FK -> `Product(Id)` | Koppeling naar Product |
| `VerpakkingsEenheid`| DECIMAL(4,1) | Nee | - | - | Verpakkingseenheid in kilogram (bijv. 5.0, 2.5) |
| `AantalAanwezig` | INT UNSIGNED | Ja | NULL | - | Huidige aantal eenheden op voorraad |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |

---

## 5. ProductPerAllergeen (Koppeltabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van koppeling |
| `ProductId` | SMALLINT UNSIGNED | Nee | - | FK -> `Product(Id)` | Koppeling naar Product |
| `AllergeenId` | SMALLINT UNSIGNED | Nee | - | FK -> `Allergeen(Id)` | Koppeling naar Allergeen |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |

---

## 6. ProductPerLeverancier (Koppeltabel)
| Veldnaam | Datatype | Nullable | Default | Sleutel | Omschrijving |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `Id` | SMALLINT UNSIGNED | Nee | AUTO_INCREMENT | PK | Unieke identificatie van levering |
| `LeverancierId` | SMALLINT UNSIGNED | Nee | - | FK -> `Leverancier(Id)` | Koppeling naar Leverancier |
| `ProductId` | SMALLINT UNSIGNED | Nee | - | FK -> `Product(Id)` | Koppeling naar Product |
| `DatumLevering` | DATE | Nee | - | - | Datum van de levering |
| `Aantal` | INT UNSIGNED | Nee | - | - | Geleverd aantal eenheden |
| `DatumEerstVolgendeLevering` | DATE | Ja | NULL | - | Verwachte datum eerstvolgende levering |
| `IsActief` | BIT / BOOLEAN | Nee | 1 | - | Indicatie of record actief is |
| `Opmerkingen` | VARCHAR(250) | Ja | NULL | - | Eventuele opmerkingen |
| `DatumAangemaakt` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd aanmaken record |
| `DatumGewijzigd` | DATETIME(6) | Nee | SYSDATE(6) | - | Datum/tijd laatste wijziging |
