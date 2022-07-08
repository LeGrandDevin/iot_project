import json
import pymysql
import bdd_config
import boto3
import logging

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
    
    inputParams = {
        "PayloadData": "TAAAzDM="
    }
    
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
