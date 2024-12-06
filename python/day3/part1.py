import re;

def main():
    inputStr = ""

    with open("./day3.txt", "r", ) as file:
        for line in file:
            inputStr += line.strip()
    
    matches = re.findall(r"mul\(\d{1,3},\d{1,3}\)", inputStr)

    total = 0
    for exp in matches:
        temp = exp[4:-1].split(",")
        total += int(temp[0])*int(temp[1])
    
    print(total)

if __name__ == "__main__":
    main()