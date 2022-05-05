# encoding: utf-8
# !/usr/bin/env python

import time
from http import cookiejar
import requests
from bs4 import BeautifulSoup
import re
import numpy as np
from fontTools import subset

BASE_URL = 'http://localhost'

headers = {
    "Host": "localhost",
    "Referer": BASE_URL,
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87'
}



# 使用登录cookie信息
session = requests.session()
session.cookies = cookiejar.LWPCookieJar(filename='cookies.txt')
try:
    print(session.cookies)
    session.cookies.load(ignore_discard=True)

except:
    print("還沒有Cookie資料")


def get_xsrf():
    print(BASE_URL)
    response = session.get(BASE_URL + '/login', headers=headers, verify=False)
    soup = BeautifulSoup(response.content, "html.parser")
    xsrf = soup.find('input', attrs={"name": "_token"}).get("value")
    return xsrf


def login(email, password, login_url):
    data = {
        'email': email,
        'password': password,
        '_token': get_xsrf(),
        'remember_me': 'true'}
    print(session.cookies)
    response = session.post(login_url, data=data, headers=headers)
    print(response)
    r = session.get(BASE_URL+'/dashboard', headers=headers)
    soup = BeautifulSoup(r.content, "html.parser")
    nav = soup.find_all("a", href=True)
    subsets = []
    for el in nav:
        if (el['href'] != '#'):
            print('擷取網址: '+el['href']) 
            try:
                r = session.get(el['href'], headers=headers)
                soup = BeautifulSoup(r.content, "html.parser")
                title = soup.find_all(['h1', 'h2', 'h3', 'h4'])
                for title_text in title:
                    if title_text:
                        subsets += title_text.text.replace(" ", "").replace("\n", "")              
            except:
                continue
    return subsets

def findHeading(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "html.parser")
    a = soup.find_all('a', href=True)
    for el in a:
        if (el['href'] != '#'):
            print('擷取網址: '+el['href']) 
            r = session.get(el['href'], headers=headers)
            soup = BeautifulSoup(r.content, "html.parser")
            title = soup.find_all(['h1', 'h2', 'h3', 'h4'])
            for title_text in title:
                if title_text:
                    subsets += title_text.text.replace(" ", "").replace("\n", "")
    return subsets

if __name__ == '__main__':
    USEREMAIL = 'bleuren@hotmail.com'
    PASSWORD = 'password'
    LOGIN_URL = BASE_URL+'/login'    
    GUEST_URL = BASE_URL
    subsets = login(USEREMAIL, PASSWORD, LOGIN_URL)
    r = requests.get(GUEST_URL)
    soup = BeautifulSoup(r.content, "html.parser")
    soup_nav = soup.find(id='header')
    nav_a = soup_nav.find_all("a")

    for el in nav_a:
        if (el['href'] != '#'):
            print('擷取網址: '+el['href']) 
            r = session.get(el['href'], headers=headers)
            soup = BeautifulSoup(r.content, "html.parser")
            title = soup.find_all(['h1', 'h2', 'h3', 'h4'])
            print(title) 
            for title_text in title:
                if title_text:
                    subsets += title_text.text.replace(" ", "").replace("\n", "")

    
    r = requests.get(BASE_URL+'/product')
    soup = BeautifulSoup(r.content, "html.parser")
    product_menu = soup.find(id='menu')
    a = product_menu.find_all('a', href=True)
    for el in a:
        if (el['href'] != '#'):
            print('擷取網址: '+el['href']) 
            r = session.get(el['href'], headers=headers)
            soup = BeautifulSoup(r.content, "html.parser")
            title = soup.find_all(['h1', 'h2', 'h3', 'h4'])
            for title_text in title:
                if title_text:
                    subsets += title_text.text.replace(" ", "").replace("\n", "")


    print('加入額外字元')
    f = open('font.txt',encoding="utf-8")
    text = f.read()
    subsets += text

    print('印出字元')
    print(subsets)
    print('移除重複字元')
    print(np.unique(subsets))
    subsets = np.unique(subsets)

    print(subsets)
    subsets = ''.join(subsets)
    #print('移除英數')
    #subsets = re.sub(r'[^\u4e00-\u9fa5]','', subsets)


    print('產生字目錄: /font/heading-webfont.txt')
    f = open('font/heading-webfont.txt', 'w')
    f.write(subsets)
    f.close()

    options = subset.Options()
    font = subset.load_font('heading.ttf', options)
    subsetter = subset.Subsetter(options)
    subsetter.populate(text=subsets)
    subsetter.subset(font)
    options.flavor = None
    print('產生字型: font/heading-webfont.ttf')
    subset.save_font(font, 'font/heading-webfont.ttf', options)
    options.flavor = 'woff'
    print('產生字型: font/heading-webfont.woff')
    subset.save_font(font, 'font/heading-webfont.woff', options)
    options.flavor = 'woff2'
    print('產生字型: font/heading-webfont.woff2')
    subset.save_font(font, 'font/heading-webfont.woff2', options)
    f.close()