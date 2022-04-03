
from xml.etree.ElementTree import tostring
import spotipy
import json
from spotipy.oauth2 import SpotifyOAuth
import requests
import random
import string
import re
import TadyNejsouAPIkeys as nic
import csv

scope = "user-library-read"

sp = spotipy.Spotify(auth_manager=SpotifyOAuth(client_id =nic.a,
                    client_secret=nic.b,
                    redirect_uri="http://google.com/",scope=scope))

#netusim jak funguji globalni promene v pythonu
xy = "x"
def addAlbumsFromBand(bandSpotifyID):
    results = sp.artist_albums(bandSpotifyID,country="CZ",album_type="album,single",limit=50)
    albums = results['items']

    #sneaky vyhození zbytečných alb tf
    for album in albums:
        global xy
        if "Live" in album['name'] :
            continue
        if "Remix" in album['name']:
            continue
        if "Spotify Session" in album['name'] :
            continue
        if xy == album['name']:
            continue

        xy = album['name']
        print("        "+album['name'])
        url_a = album['images'][0]['url']

        r_a = requests.get(url_a, allow_redirects=True)
        open("Covers_poster/cover_"+str(album['name'])+".jpg", 'wb').write(r_a.content)

f = open("insert.txt", "w")
with open("spotipyInsert/bands.csv", 'r') as file_b:
    reader = csv.reader(file_b)
    for row in reader:
        addAlbumsFromBand("spotify:artist:"+str(row[1]))
