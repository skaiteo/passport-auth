import sys
import json
from passporteye import read_mrz

#Obtain Image from the argument
image_file = sys.argv[1]
# print(image_file)
#Pass image into Read_MRZ functionality and store inside MRZ Variable
mrz = read_mrz(image_file)

#Change the data into dictionary of series or list like data type,
#Similar to JSON but not really, then store inside MRZ_Data variable
mrz_data = mrz.to_dict()

#Change the format of MRZ_DATA into JSON Format 
jsonvalue = json.dumps(mrz_data)

#Prints the JSON VALUE for PHP
print(jsonvalue)

#I didnt use return because non of this code is inside a class or a method
