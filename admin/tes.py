sysname R1
interface GigabitEthernet 0/0/0
ip address 10.10.10.1 24
interface GigabitEthernet 0/0/1
ip address 192.168.1.1 24
interface GigabitEthernet 0/0/2
ip address 192.168.2.1 24
q

sysname R2
interface GigabitEthernet 0/0/0
ip address 10.10.10.2 24
interface GigabitEthernet 0/0/1
ip address 192.168.3.1 24
q

ip route-static 192.168.3.0 255.255.255.0 10.10.10.2
ip route-static 192.168.1.0 255.255.255.0 10.10.10.1
ip route-static 192.168.2.0 255.255.255.0 10.10.10.1

acl 2001
rule deny source 192.168.1.2 0
rule permit source any
interface GigabitEthernet 0/0/1
traffic-filter inbound acl 2001
q


acl 2002
rule deny source 192.168.2.2 0
rule permit source any
interface GigabitEthernet 0/0/0
traffic-filter outbound acl 2002
q
