ORDERLEN = 1176

def main():

    smaller = {}
    pages = []
    with open("./day5.txt", "r", ) as file:
        for num, line in enumerate(file):
            if (num < ORDERLEN):
                tempList = line.strip().split("|")

                smaller.setdefault(int(tempList[1]), set())
                smaller[int(tempList[1])].add(int(tempList[0]))
            elif (num > ORDERLEN):
                pages.append(list(map(int, line.strip().split(","))))

    total = 0
    for row in pages:
        for i, num in enumerate(row):
            if num not in smaller.keys() or not smaller[num].issuperset(row[0:i]):
                break
        else:
            total += row[int(len(row)/2)]
    
    print(total)

if __name__ == "__main__":
    main()