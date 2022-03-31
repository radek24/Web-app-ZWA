
from xml.etree.ElementTree import tostring
import spotipy
import json
from spotipy.oauth2 import SpotifyOAuth
import requests
import random
import string
import re

#miluji globální proměné, a veřejné API klíče
scope = "user-library-read"
spotifyArtist = 'spotify:artist:41X1TR6hrK8Q2ZCpp2EqCz'
infoAboutArtist= "Alexander Leon Gumuchian (born June 30, 1995), better known as bbno$ (pronounced as baby no money), is a Canadian rapper, singer, and songwriter from Vancouver, British Columbia."


sp = spotipy.Spotify(auth_manager=SpotifyOAuth(client_id ="2d54c7e543714f0fa7ec6d2d86be9499",
                    client_secret="dab2f8c8a42a45d9bea384a0cd7dfe08",
                    redirect_uri="http://google.com/",scope=scope))

def addAlbumsFromBand(bandindex,bandSpotifyID,file):
    results = sp.artist_albums(bandSpotifyID,country="CZ",album_type="album",limit=50)
    albums = results['items']
    
    for album in albums:
        if "Live" in album['name']:
            continue
        file.write("INSERT INTO `albums` (`id`, `name`, `band_id`, `cover`, `single`) VALUES")
        random.seed(album['id'])
        AlbumID = round(random.random()*1000000)
        issingle = 0
        if  album['album_type']  ==  'album':
            issingle = 0
        elif album['album_type'] ==  'single':
            issingle = 1
        

        url_a = album['images'][1]['url']

        r_a = requests.get(url_a, allow_redirects=True)
        open("Img/Covers/cover"+str(AlbumID)+".jpg", 'wb').write(r_a.content)
        CoverPath = "cover"+str(AlbumID)+".jpg"

        alb = re.sub(r'[^\x00-\x7f]',r'', album['name'])

        file.write("('"+str(AlbumID)+"',\""+alb+"\",'"+str(bandindex)+"','"+CoverPath+"','"+str(issingle) +"');\n")
        addSongsFromAlbum(AlbumID,album['id'],file)

def addSongsFromAlbum(albumindex,albSpotifyID,file):
    results = sp.album_tracks(album_id=albSpotifyID)
    file.write("INSERT INTO `songs` (`id`, `name`, `album_id`, `lenght`, `order`, `spotify_link`) VALUES")

    for idx,item in enumerate(results['items']):
        if(idx!=0):
            file.write(",")
        file.write("(")
        nm = re.sub(r'[^\x00-\x7f]',r'', item['name'])
        file.write("NULL,\""+nm+"\",'"+str(albumindex)+"','" + str(round(item['duration_ms']/1000))+"','"+str(idx+1)+"','"+ item['external_urls']['spotify']+"')")
        #       id      name           albumid              lenght                              order           spotify link
    file.write(";\n")

#create file
f = open("insert.txt", "w")
#define unique id for band
artist = sp.artist(spotifyArtist)


random.seed(artist['id'])
BandID = round(random.random()*1000000)

url = artist['images'][1]['url']
r = requests.get(url, allow_redirects=True)


open("Img/Bands/band"+str(BandID)+".jpg", 'wb').write(r.content)
photoPath = "band"+str(BandID)+".jpg"


f.write("INSERT INTO `bands` (`id`, `name`, `info`, `photo`) VALUES")
f.write("('"+str(BandID)+"','"+artist['name']+"','"+ infoAboutArtist +"','"+photoPath+"');\n")

addAlbumsFromBand(BandID,spotifyArtist,f)
