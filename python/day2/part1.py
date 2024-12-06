def main():
    list1 = []

    with open("./day2.txt", "r", ) as file:
        for line in file:
            list1.append(list(map(int, line.strip().split(" "))))
    
    count = 0
    for record in list1:
        if (isSafe(record)):
            count += 1
    
    print(count)

def isSafe(record: list) -> bool:
    if record[1] > record[0]:
        asc = True
    else:
        asc = False
    
    for i in range(len(record)-1):
        if record[i] < record[i+1]:
            nextAsc = True
        else:
            nextAsc = False
        
        if nextAsc != asc:
            return False

        if (record[i+1] - record[i]) < -3 or (record[i+1] - record[i]) > 3 or record[i+1] == record[i]:
            return False
    return True

if __name__ == "__main__":
    main()