
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

def addAlbumsFromBand(bandindex,bandSpotifyID,file):
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
        file.write("INSERT INTO `albums` (`id`, `name`, `band_id`, `cover`, `single`,`releaseyear`) VALUES")
        
        # 2 náhodné čísla nikdy nemůžou být stejné ne?
        random.seed(album['id'])
        AlbumID = round(random.random()*1000000000)
        
        print("        "+album['name'])
        #zjist, jestli je to single
        issingle = 0
        if  album['album_type']  ==  'album':
            issingle = 0
        elif album['album_type'] ==  'single':
            issingle = 1
        
        yearofrelease= album['release_date'][0:4]
        url_a = album['images'][1]['url']

        r_a = requests.get(url_a, allow_redirects=True)
        open("Img/Covers/cover"+str(AlbumID)+".jpg", 'wb').write(r_a.content)
        CoverPath = "cover"+str(AlbumID)+".jpg"

        alb = re.sub(r'[^\x00-\x7f]',r'', album['name'])

        file.write("('"+str(AlbumID)+"',\""+alb.replace("\"","")+"\",'"+str(bandindex)+"','"+CoverPath+"','"+str(issingle) +"','"+yearofrelease+"');\n")
        addSongsFromAlbum(AlbumID,album['id'],file)


# nechapu jak tohle funguje, ale funguje tak do toho nehrabu
def addSongsFromAlbum(albumindex,albSpotifyID,file):
    results = sp.album_tracks(album_id=albSpotifyID)
    file.write("            INSERT INTO `songs` (`id`, `name`, `album_id`, `lenght`, `order`, `spotify_link`) VALUES")

    for idx,item in enumerate(results['items']):
        if(idx!=0):
            file.write(",")
        file.write("(")
        #tohle posefuje ne-ascii znaky (myslim, je to zkopirovane z Stackoverflow)
        nm = re.sub(r'[^\x00-\x7f]',r'', item['name'])
        file.write("NULL,\""+nm.replace("\"","")+"\",'"+str(albumindex)+"','" + str(round(item['duration_ms']/1000))+"','"+str(idx+1)+"','"+ item['external_urls']['spotify']+"')\n")
        #       id      name           albumid              lenght                              order           spotify link
    file.write(";\n")



def addBand(artistpar,file,info):
    artist = sp.artist(artistpar)
    # vis jak

    random.seed(artist['id'])
    BandID = round(random.random()*100000000)

    # ukladani obrazku
    url = artist['images'][1]['url']
    r = requests.get(url, allow_redirects=True)
    open("Img/Bands/band"+str(BandID)+".jpg", 'wb').write(r.content)
    photoPath = "band"+str(BandID)+".jpg"

    print("adding: "+artist['name'])
    file.write("INSERT INTO `bands` (`id`, `name`, `info`, `photo`) VALUES")
    file.write("('"+str(BandID)+"','"+artist['name']+"','"+ info +"','"+photoPath+"');\n")

    addAlbumsFromBand(BandID,artistpar,file)





f = open("insert.txt", "w")
with open("spotipyInsert/bands.csv", 'r') as file_b:
    reader = csv.reader(file_b)
    for row in reader:
        addBand("spotify:artist:"+str(row[1]),f,row[2])
