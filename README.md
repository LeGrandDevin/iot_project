# iot_project


Projet IoT
Damien, Ibrahim, Stéphane, Victor












Sommaire

Design d’architecture	3
La technologie LoRaWAN	4
LoRaWAN : Définition	4
La passerelle kerlink	4
Capteur adeunis comfort :	4
Ce que nous en avons fait :	4
Les services Cloud	5
AWS	5
Lambda	5
Schéma de fonctionnement	6
Rule “Groupe4RuleRoute”:	6
Fonction 1 “Function_Groupe4” :	7
Fonction 2 “Groupe4BDD” :	8
Gestion des données	9
Interface Web	10
Documentation Utilisateur	11
Page de connexion	11
Les tableaux	12
Documentation Administrateur	13
Ajouter des capteurs	13
Ajouter des utilisateurs depuis le site Web	13
Rafraîchissement dynamique	13
Mise en production du site Web	14
Mise en production de la base de données	14
Cybersécurité	15
Définition :	15
LoRaWan	15
Sécurité cloud	15
Sécurité web:	16
Sécurités pour le futur?	17
Annexes	18
LIEN DU RÉPERTOIRE GITHUB :	18
Fonction Function_Groupe4	19
Fonction GRP4BDD	20
Script CRÉATION BDD	21

Design d’architecture

Projet iot : les technologies Lorawan avec la passerelle lorawan ………………4
collecte de données grâce à un capteur lié à la passerelle ………………………4
AWS :  une solution cloud ……………………………………………………………..5
Gestion de données……………………..……………………………………………….9
Interface web……………………………………….. ……………………………………10



Le capteur Lorawan émet ses données périodiquement. 
La passerelle reçoit ces données et les renvoie sur AWS IOT Core, une solution en cloud de gestion de périphériques envoie les données dans le serveur et on les valorise en les utilisant sur le site


La technologie LoRaWAN
LoRaWAN : Définition
LoRaWAN est un protocole LPWAN (Low Power Wide Area Network), construit sur la technologie RF sans fil LoRa de Semtech et promu par l’Alliance LoRa, qui prend en charge les communications bidirectionnelles de bout en bout à longue portée, économiques, mobiles, économes en énergie, couverture intérieur étendue et sécurisées pour les applications Internet des objets (IoT) et Machine to Machine (M2M). Fonctionnant sur des fréquences ISM sans licence dans le monde entier, cette connectivité est spécifiquement dédiée aux cas d’utilisation d’IoT et permet des déploiements et des opérations rentables pour les réseaux publics ou privés.

La passerelle kerlink
Cette passerelle est le maillon central d'un système IoT LoRaWAN. Elle collecte les informations des capteurs LoRa cette passerelle est connecté au réseaux OPEN IT et lié à AWS elle permet la communication du capteur avec le service cloud et permet aussi de sécuriser le système  De plus le software est sécurisé permettant un démarrage sans problème et l'ajout d'un protocole de sécurité concernant l'adresse IP de la machine.

Capteur adeunis comfort :
Le LoRaWAN Smart Building CoMFORT d'aunis® est un émetteur radio permettant la mesure de la température et de l’humidité ambiante.
Ce produit permet de monitorer la température et l’humidité d’un lieu via un réseau LPWAN.
Le produit émet les données périodiquement ou sur dépassement de seuils haut ou bas.
La configuration de l’émetteur est accessible par l’utilisateur en local via un port micro-USB ou à distance via le réseau LoRaWAN, permettant notamment le paramétrage de la périodicité, des modes de transmission ou encore des seuils d’alarme.

Ce que nous en avons fait :
Dans le cadre de ce projet iot il a fallu associé la passerelle lorawan à aws cloud, pour cela on a créé et téléchargé des certificat copié les CUPS et LNS, cela permet de vérifier l'authenticité des points de terminaison AWS IoT Core LoRaWAN, et la passerelle utilisera donc un certificat de confiance pour chacun des points de terminaison CUPS et LNS. 
on a ensuite ajouter le capteur sur adeunis comfort sur aws.
Une fois cette partie configurée, on peut commencer à utiliser AWS IoT core et AWS Lambda.
Les services Cloud

AWS
Amazon Web Services (AWS) est une division du groupe américain de commerce électronique Amazon, spécialisée dans les services de cloud computing à la demande pour les entreprises et les particuliers

AWS IoT fournit les services cloud qui connectent les équipements IoT à d'autres appareils et aux services cloud AWS. AWS IoT fournit des logiciels pour les équipements qui permettent d’intégrer les appareils IoT dans des solutions basées sur AWS IoT. 

AWS IoT Core prend en charge les protocoles suivant :
mqtt
mqtt wss
https
lorawan

aws correspond parfaitement au projet iot car il prend en charge le protocole lorawan

Lambda
AWS Lambda est un service de calcul d'événement sans serveur qui permet d'exécuter du code pour notre cas d’utilisation sans se soucier de l'allocation ou de la gestion des serveurs.
Lambda est utilisé pour décoder les trames envoyées par le capteur.
Une fonction est créée pour le cryptage de données et  une deuxième fonction est utilisée pour envoyer les données au serveur.
Schéma de fonctionnement


Rule “Groupe4RuleRoute”:
Cette règle fait la liaison entre la destination lorawangrp4 et la fonction de décodage des données “Function_Groupe4”.



Fonction 1 “Function_Groupe4” :
Utilité:

Cette fonction sert à récupérer les données envoyées par la règle Groupe4RuleRoute et à les décoder.
Le décodage des données se fait en traduisant le payload en base64 puis en le décodant de la manière suivante:
Le payload est renvoyé car cette fonction est appelée dans la fonction numéro 2 : Grp4BDD.

        const bf = Buffer.from(PayloadData, 'base64')

On récupère le Payload dans un buffer


        payload.raw = bf.toString('hex')

On le traduit en Hexadécimal afin de pouvoir le décoder


        //Décodage du niveau de la batterie
        payload.BAT_LEVEL = (bf.readUInt16BE(0) & 0x3FFF)

        //Décodage de la température mesurée par le capteur
        payload.TEMPERATURE = (bf.readUInt16BE(2)) / 10

        //Décodage de l'humidité mesurée par le capteur
        payload.HUMIDITY = bf[4]

Ensuite on utilise les formules ci-dessus afin de traduire les données au bon format.

Fonction 2 “Groupe4BDD” :
prérequis:

cette fonction sert à envoyer les données au serveur pour cela il faut lié pymysql à aws et crée une fonction en python 3.8.0, dans un premier temps il faut télécharger pymysql sur un pc en local, récupérer le fichier pymysql et le mettre sous format zip.
une fois cette étape faite lambda met à disposition un système de layer c’est ce qui permet d'utiliser pymysql dans lambda 

il faut crée un fichier de config ici ce sera bdd_config où l'on mettra les logs pour ce connecter à la bdd , puis on fait un importe toute les technologie qu’il faut (json, pymysql pour la db, bdd_config pour les logs, boto3 pour lié la fonction 1 à la fonction 2 sur lambda et enfin logging pour se connecter).

Puis pour gérer boto3 il faut créer un rôle iam dans lequel il y aura une policy  pour autoriser la fonction 2 a invoke la fonction 1  la policy est la suivante:

explication du code :

cette partie du code permet de tester la connection au serveur et de s’y connecter 




cette partie du code permet de lié la fonction 1 à la fonction 2 ce qui va nous permettre de récupérer les données décrypté

et enfin on fait une requête sql pour envoyer la donnée
Gestion des données

La base de donnée est hébergée sur un serveur distant, on utilise un serveur mysql,
Il y a deux tables, une pour les utilisateurs nommée credentials et une pour les données mesurées nommée captorData.










Ces deux fonctions nous montrent comment récupérer les données et comment les formater afin de pouvoir les utiliser dans notre composant de dashboard.


Interface Web
Front-end :
Pour le front-end, nous avons utilisé les technologies html css et js car ces technologies sont fiables, faciles d’utilisation, et connues de nos développeurs. 


L’affichage des graphiques a été fait avec Chart.js, une librairie JavaScript adéquate à la création de ces derniers.

L’affichage des tables a été réalisé avec DataTables, une autre librairie JavaScript qui utilise jQuery.


Back-end :
Nous avons décidé de faire le back-end en php, et nous avons utilisé PDO pour récupérer nos données dans la base de données et les traiter pour les envoyer au front.

Depuis le navigateur les pages accessibles sont : 
login.php
vérifie si l’utilisateur est connecté
sinon propose un formulaire de connexion
dashboard.php
accessible uniquement si connecté
centralise l’affichage de toutes les données de notre capteur
graphs.php
accessible uniquement si connecté
permet de voir uniquement les graphiques de notre capteur
tables.php
accessible uniquement si connecté
permet de voir uniquement les tables de notre capteur

Les autres fichier permette l’organisation du code : 
toolBox.php
centralise un nombre de fonctions utiles dans notre code
isConnected.php
vérifie si notre utilisateur est bien connecté
inclue dans tous les fichiers dont la connexion est nécessaire pour y accéder
header.php
contient le header et le menu de navigation situé à droite de l’écran
inclue dans tous les fichiers dont la connexion est nécessaire pour y accéder
logout.php
déconnecte l’utilisateur et le redirige vers la page login.php
graphshumidity.php / graphstemp.php / tableBack.php
gère la transformation des donnés de la base de donnée vers les graphiques
inclue dans la page dashboard.php et graphs.php et tables.php
Documentation Utilisateur
Page de connexion
Nous avons développé à l’occasion du projet de fin d’année de bachelor en collaboration avec l’entreprise SPIE, un site web permettant la récupération des données d’un capteur de température et d’humidité afin de notifier, à terme, les utilisateurs lorsque la température et l’humidité ambiante n’est pas idéale (d’après des études que nous avons faites sur les conditions de travail idéale en environnement clôt).
Dans un premier temps il a fallu créer une page de login, l’utilisateur s’identifie grâce à un identifiant et un mot de passe et si nous avons déjà une session ouverte nous avons une redirection.









l’identification faite avec succès nous sommes redirigé vers la page home dans cette page-ci on voit notre graphique humidité, un graphique température et enfin une table qui montre en détails les données que l’on récupère.
Les graphiques:


 



Les tableaux
Elles sont également affichées sous la forme d’un tableau. →
Ce tableau possède un champ de recherche permettant de trouver rapidement une donnée



















La home page:
il y a la partie dashboard ou il y a l’ensemble des affichages, la partie graphique ou il n y a que les courbes et une onglet tables ou il y’a le tableau enfin en haut à gauche nous avons accès au bouton déconnexion pour fermer la session
Documentation Administrateur
Ajouter des capteurs
Pour ajouter des capteurs il suffit de connecter un nouveau capteur Lorawan à la Passerelle et à le paramétrer de façon à ce qu’il envoie ses données sur la destination lorawangrp4.

Il faudra pour la gestion de plusieurs capteurs, ajouter la variable WirelessDeviceId dans la table captorData afin de pouvoir identifier chaques capteurs.

Ajouter des utilisateurs depuis le site Web
A terme, l’administrateur pourra créer des utilisateurs directement sur le site Web via un formulaire.

Un système de droit sera implémenté afin d’autoriser chaque utilisateur à pouvoir créer ou non d’autres utilisateurs.







Rafraîchissement dynamique
Un rafraîchissement dynamique de l’affichage des données sur le site sera configurable par l’administrateur afin de gérer la fréquence de donner envoyé à la page. On pourrait utiliser les dashboards et les tableaux afin d’effectuer un monitoring sur mesure.

Mise en production du site Web

Pour mettre en production le site Web 
mettre en place un server web apache configurer pour php et y importer le code du site web
il faut s’assurer que les page :
toolBox.php, isConnected.php, header.php, logout.php, graphshumidity.php, graphstemp.php, tableBack.php soit inaccessible depuis le web via htaccess notamment

Mise en production de la base de données

Pour mettre en production la base de données configurer un serveur de base donnée (local ou distant) MySql, lancer le script de base de donnée se trouvant dans dbCreation.sql ou l’annexe ‘Script CRÉATION BDD’,  renseigner les informations de connexion dans les fichiers de configuration config.php pour le site web et bdd-config.py sur AWS lambda

Cybersécurité
Définition :

La cybersécurité consiste à protéger les ordinateurs, les serveurs, les appareils mobiles, les systèmes électroniques, les réseaux et les données contre les attaques malveillantes. On l’appelle également sécurité informatique ou sécurité des systèmes d'information.

LoRaWan
LoRaWAN offre deux couches pérennes de sécurité de bout-en-bout.
Une pour le réseau qui assure l’authentification mutuelle entre le dispositif LoRaWAN et le réseau LoRaWAN dans le cadre de l’association au réseau (Join). Cela certifie que le trafic réseau n’a pas été altéré, et provient uniquement d’un dispositif légitime, autorisé à s’attacher à un réseau authentique, n’est pas intelligible par un espion, et n’a pas été enregistré et rejoué par un acteur malveillant.


Une pour l'application qui assure que l’opérateur de réseau n’a pas accès aux données de l’utilisateur final. LoRaWAN est un des seuls réseaux de l’Internet des Objets à implémenter le chiffrement de bout-en-bout des données utilisateur échangées entre les dispositifs terminaux et les serveurs applicatifs. Dans les réseaux cellulaires traditionnels, le trafic est chiffré sur le lien radio, mais transmis en clair dans le cœur de réseau de l’opérateur, obligeant l’utilisateur à choisir et déployer une couche de sécurité additionnelle (Réseau privé virtuel (VPN) ou une couche de chiffrement applicatif dédiée).
Sécurité cloud
La sécurité aws est gérée grâce à l’interface iam : AWS Identity and Access Management (IAM) est un service web qui permet de contrôler l'accès aux ressources AWS. On utilise  IAM pour contrôler les personnes qui s'authentifient (sont connectées) et sont autorisées (disposent d'autorisations) à utiliser des ressources. Avec AWS, on contrôle à tout moment où sont stockées les données, qui peut y avoir accès et les ressources que nous consommons.
Les informations de la base de données sont stockées dans un fichier externe à la fonction Groupe4BDD, ce fichier pourrait à terme être délocalisé et sécurisé afin de ne pas être visible par les administrateurs des fonctions AWS.

Sécurité web:
sécurités php:

1- Quand register_globals est en “on”, les variables EGPCS (Environnement, GET, POST, Cookie, Server) sont enregistrées comme des variables globales. Ainsi, une URL contenant une variable, par exemple http://www.site.com/index.php?var=test crée une variable $var sans besoin d'autre code. De manière générale, il faut éviter au maximum les variables globales et utiliser des flots de données explicites.

2- Pour éviter que des données non voulues soient injectées dans le code (requêtes SQL, commandes Shell, cross site scripting), il faut vérifier chaque donnée avant de les passer en paramètres à des fonctions du système. Il s'agit de tester si les variables sont bien du type attendu. Il est aussi conseillé d'initialiser chaque variable. Pour s’assurer de cela, nous avons vérifié que le login entré était bien uniquement composé de caractères alphanumériques et le password et d'abord hashé avant d’être utilisé.

3- Le journal d'erreur est un bon indicateur pour repérer les attaques. Pour enregistrer toutes les erreurs d'exécution, on a ajouté la ligne <?php error_reporting(E_ALL); ?> au début de chaque page de code.  

4- On a privilégié l’utilisation de session afin de se préserver des failles qu’apporte les cookies, on utilise seulement le cookie ssid car il est nécessaire à la maintenance des sessions pour la navigation dans le site web.

5- Parfois trop restrictive, une vérification sur le nom du groupe peut suffire, en utilisant la directive safe_mod_gid. La variable Open_basedir limite les manipulations aux fichiers situés dans les dossiers spécifiés. Il est également possible de désactiver individuellement des fonctions avec disable_functions. Disable_classes fonctionne de la même manière et permet de désactiver individuellement des classes.










Sécurités pour le futur?

Il est essentiel de protéger nos outils des personnes ayant des mauvaises intentions, surtout si ces derniers peuvent (si réussissent à accéder à notre système) interagir avec de la domotique. 
Par conséquent : 
Si dans le futur, un ajout d’une fonction pour l’ouverture des volets roulants ou autres à travers un bouton est réalisé, il faudra faire attention à tout ce qui est utilisateur, qu’ils soient bien au courant des règles à suivre : ne pas laisser sa session ouverte lorsque l’on n’est pas sur son ordinateur, ne pas donner ses identifiants à qui que ce soit.

Si automatisation avec un script dans le futur pour ouverture des volets roulants ou autres, il faudra faire attention à l’accès de la base de donnée, à la fiabilité des capteurs, que personne ne puisse les impactés et donc impacté les données par la même occasion ainsi que l’automatisation de ce script.

Pour obtenir une transmission de données sécurisée de bout en bout sur Internet, utilisez toujours les certificats SSL dans une application. Il s'agit d'un protocole standard reconnu mondialement connu sous le nom de protocole de transfert hypertexte (HTTPS) pour transmettre des données entre les serveurs en toute sécurité. En utilisant un certificat SSL, l’application obtient le chemin de transfert de données sécurisé, ce qui rend presque impossible pour les pirates de s'introduire sur le serveur.







Annexes

LIEN DU RÉPERTOIRE GITHUB :
https://github.com/LeGrandDevin/iot_project


Fonction Function_Groupe4
exports.handler = async (event) => {
      try {

        const {PayloadData} = event        
        const bf = Buffer.from(PayloadData, 'base64')
        
        
        let payload = {}
        //récupération de la date de réception des données
        payload.date_time = new Date().toISOString().slice(0, 19).replace('T', ' ');
        //Récupération du payload en hexadécimal
        payload.raw = bf.toString('hex')
        //décodage du niveau de batterie
        let BAT_STATUS = bf.readUInt8(0) >> 6
        switch (BAT_STATUS) {
            case 0:
                payload.BAT_STATUS = 'Ultra Low'
                break
            case 1:
                payload.BAT_STATUS = 'Low'
            case 2:
                payload.BAT_STATUS = 'OK'
                break
            case 3:
                payload.BAT_STATUS = 'Good'
            default:
                break
        }
        payload.BAT_LEVEL = (bf.readUInt16BE(0) & 0x3FFF)
        //décodage de la température mesurée par le capteur
        payload.TEMPERATURE = (bf.readUInt16BE(2)) / 10
        //décodage de l'humidité mesurée par le capteur
        payload.HUMIDITY = bf[4]
        //débuggage
        //console.log(payload)
        
        return {
           "payload" : payload
        }
    } catch (e) {
        console.log(e)
    }
}





Fonction GRP4BDD
bdd_host = bdd_config.db_endpoint
name = bdd_config.db_username
password = bdd_config.db_password
db_name = bdd_config.db_name
port = 3306
# invokation
client = boto3.client('lambda')
# logs
logger = logging.getLogger()
logger.setLevel(logging.INFO)

try:
    conn = pymysql.connect(host=bdd_host, user=name, passwd=password, db=db_name, connect_timeout=5 , cursorclass=pymysql.cursors.DictCursor)
except pymysql.MySQLError as e:
    logger.error("ERROR: Unexpected error: Could not connect to MySQL instance.")
    logger.error(e)
    sys.exit()
    
logger.info("SUCCESS: Connection to MySQL instance succeeded")
lambda_client = boto3.client('lambda', region_name='us-east-1')

def lambda_handler(event, context):
    response = client.invoke(
        FunctionName = 'arn:aws:lambda:us-east-1:075281813833:function:Function_Groupe4',
        InvocationType = 'RequestResponse',
        Payload = json.dumps(event)
    )
    
    responseFromChild = json.load(response['Payload'])
    for key in responseFromChild:
        value = responseFromChild[key]
        
    item_count = 0
    with conn.cursor() as cur:
        cur.execute("INSERT INTO captorData VALUES (%s, %s, %s, %s)", (0, value['HUMIDITY'], value['TEMPERATURE'],  value['date_time']))
        conn.commit()
        body = cur.fetchall()
    return {
        'statusCode': 200,
        'headers': {
            'Access-Control-Allow-Origin': '*',
            'Access-Control-Allow-Headers': 'Content-Type,X-Amz-Date,Authorization,X-Api-Key,X-Amz-Security-Token',
            'Access-Control-Allow-Credentials': 'true',
            'Content-Type': 'application/json'
        },
        'body': json.dumps(body)
    } 

Script CRÉATION BDD

MySQL Workbench Forward Engineering SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0; SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0; SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'; Schema u928306449_groupe_quatre Schema u928306449_groupe_quatre 

CREATE SCHEMA IF NOT EXISTS u928306449_groupe_quatre DEFAULT CHARACTER SET utf8 ; USE u928306449_groupe_quatre ; Table u928306449_groupe_quatre.credentials 

CREATE TABLE IF NOT EXISTS u928306449_groupe_quatre.credentials ( idCredential INT NOT NULL AUTO_INCREMENT, password VARCHAR(45) NOT NULL, identifiant VARCHAR(45) NOT NULL, PRIMARY KEY (idCredential)) ENGINE = InnoDB; -- Table u928306449_groupe_quatre.captorData 

CREATE TABLE IF NOT EXISTS u928306449_groupe_quatre.captorData ( idcaptorData INT NOT NULL AUTO_INCREMENT, humidity FLOAT NOT NULL, temperature FLOAT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY (idcaptorData)) ENGINE = InnoDB; SET SQL_MODE=@OLD_SQL_MODE; SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS; SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


