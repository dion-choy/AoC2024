def main():
    list1 = []
    dict1 = {}

    with open("./day1.txt", "r", ) as file:
        for line in file:
            tempList = line.strip().split("   ")
            list1.append(int(tempList[0]))

            dict1.setdefault(int(tempList[1]), 0)
            dict1[int(tempList[1])] += 1

    total = 0
    for num in list1:
        if num in dict1.keys():
            total += num * dict1[num]

    print(total)

if __name__ == "__main__":
    main()