import re;

def main():
    inputStr = ""

    with open("./day3.txt", "r", ) as file:
        for line in file:
            inputStr += line.strip()
    
    matches = re.findall(r"don't\(\)|mul\(\d{1,3},\d{1,3}\)|do\(\)", inputStr)

    total = 0
    do = 1
    for exp in matches:
        if exp[0:3] == "mul":
            exp = exp[4:-1].split(",")
            total += int(exp[0]) * int(exp[1]) * do
        elif exp[0:3] == "don":
            do = 0
        else:
            do = 1

    print(total)

if __name__ == "__main__":
    main()