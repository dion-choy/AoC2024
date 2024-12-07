ORDERLEN = 21;

def main():

    smaller = {}
    bigger = {}
    pages = []
    with open("./dayTest.txt", "r", ) as file:
        for num, line in enumerate(file):
            if (num < ORDERLEN):
                tempList = line.strip().split("|")

                bigger.setdefault(int(tempList[0]), set())
                bigger[int(tempList[0])].add(int(tempList[1]))

                smaller.setdefault(int(tempList[1]), set())
                smaller[int(tempList[1])].add(int(tempList[0]))
            elif (num > ORDERLEN):
                pages.append(list(map(int, line.strip().split(","))))

    total = 0
    for row in pages:
        for i, num in enumerate(row):
            if num in bigger.keys() and not bigger[num].issuperset(row[i+1:]):
                break
            if num in smaller.keys() and not smaller[num].issuperset(row[0:i]):
                break
        else:
            total += row[int(len(row)/2)]
    
    print(total)

if __name__ == "__main__":
    main()