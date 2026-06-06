#!/bin/bash

clear

echo -e "\e[1;31m" # Merah Tebal
echo "  ██████╗███████╗ ██████╗ ██████╗  █████╗ ██████╗ ██████╗  █████╗ ██████╗ "
echo "  ██╔════╝██╔════╝██╔═══██╗██╔══██╗██╔══██╗██╔══██╗██╔══██╗██╔══██╗██╔══██╗"
echo "  ╚█████╗ █████╗  ██║   ██║██████╔╝███████║██████╔╝██████╔╝███████║██████╔╝"
echo "   ╚═══██╗██╔══╝  ██║   ██║██╔══██╗██╔══██║██╔══██╗██╔══██╗██╔══██║██╔══██╗"
echo "  ██████╔╝███████╗╚██████╔╝██████╔╝██║  ██║██║  ██║██████╔╝██║  ██║██║  ██║"
echo "  ╚═════╝ ╚══════╝ ╚═════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝"
echo -e "\e[0m"

echo -e "                     \e[1;31m[!] HACKED BY SEOBARBAR [!]\e[0m"
echo -e "   \e[1;30m====================================================================\e[0m"
echo ""
echo -e "\e[1;31m[-]========================================================================[-]\e[0m"
echo -e "      \e[1;37m☠  WARNING: YAHAHA MAU NYOBA MASANG GS YAK? SEPELE BOSKUH  ☠\e[0m"
echo -e "\e[1;31m[-]========================================================================[-]\e[0m"
echo ""

echo -e "\e[1;30m[system@security]:~# proceed connection? y/N\e[0m"
echo ""
echo -e "\e[1;31m[!] Authentication Required for SEOBARBAR Core Infrastructure...\e[0m"
echo -n -e "\e[1;33m[+] Enter Password: \e[0m"
read -r input_password

if [ "$input_password" = "pinjamdulu100" ]; then
    echo ""
    echo -e "\e[1;32m[+] ACCESS GRANTED. Welcome Back, Boss.\e[0m"
    echo -e "\e[1;32m[+] Initializing secure shell environment...\e[0m"
    sleep 1
    clear
    
    PASSED_AUTH=1 exec /bin/bash
else
    echo ""
    echo -e "\e[1;31m[-] ACCESS DENIED! SYSTEM LOCKED.\e[0m"
    sleep 1
    exit 1
fi
