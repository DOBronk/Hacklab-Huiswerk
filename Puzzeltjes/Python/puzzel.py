import logging
import random
import socket
from struct import pack, unpack
import bitstring

# De textbestanden moeten in de folder van script staan 
import os
import sys

scriptfolder = os.path.dirname(os.path.realpath(sys.argv[0]))

# The Notorious Chef's Disaster Dish

def OrdenData(regel):
    waardes = ["",""]
    aantal = 0
    for letter in regel:
        if not letter.isnumeric():
            waardes[0 + (aantal > 0)] += letter
        else:
            aantal = int(letter)
    
    return waardes[0], waardes[1], aantal

bestand = open(f"{scriptfolder}\\flavor_ingredients_dataset.txt")
data = {}

while regel := bestand.readline().strip():
    smaak, ingredient, aantal = OrdenData(regel)
    try:
        data[smaak, ingredient] += aantal
    except:
        data[smaak, ingredient] = aantal

spicy = sweet = sour = bitter = salty = 0

for smaak, ingredient in data:
    aantal = data[smaak, ingredient]
    match smaak:
        case "Spicy":
            spicy += aantal
        case "Sweet":
            sweet += aantal
        case "Sour":
            sour += aantal
        case "Bitter":
            bitter += aantal
        case "Salty":
            salty += aantal

toxratio = (sweet + (sour * 2) + (bitter * 3) + (salty * 4) + (spicy * 5)) / (sweet + sour + bitter + salty + spicy)
print(toxratio)

# Toxicity Ratio = 2.891891891891892
             
# Deciphering the Fragmented Password
                         
def VerwerkTextBestand(bestandsnaam):
    bestand = open(f"{scriptfolder}\\{bestandsnaam}")
    regels = dict()
    while regel := bestand.readline():
        if(regel.count("[")):
            pos = int(regel[regel.find("[") + 1:regel.find("]")].split("/")[0])
            regels[pos] = regel[regel.find("]") + 1:].strip()
    return regels

delen = VerwerkTextBestand("GroceryList.txt") | VerwerkTextBestand("WorkSchedule.txt") | VerwerkTextBestand("TravelItinerary.txt") | VerwerkTextBestand("FitnessPlan.txt") | VerwerkTextBestand("RecipeCollection.txt")
wachtwoord = str()

for i in range(1,21):
    wachtwoord += delen[i]

print(wachtwoord)

# Output: P4rt1cul@rSecre7Passw0rd!IsC0mplexD4taEncrypT!onMeth0dAlgoRithM!cSaf3