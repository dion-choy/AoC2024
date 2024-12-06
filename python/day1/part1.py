def main():
    list1 = []
    list2 = []

    with open("./day1.txt", "r", ) as file:
        for line in file:
            tempList = line.strip().split("   ")
            list1.append(int(tempList[0]))
            list2.append(int(tempList[1]))
    
    sum = 0
    for _ in range(len(list1)):
        num1 = min(list1) 
        num2 = min(list2) 
        sum += abs(num1 - num2)
        list1.remove(num1)
        list2.remove(num2)
    
    print(sum)


if __name__ == "__main__":
    main()